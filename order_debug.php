<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'Library/Entities/Location.php';
require_once 'Library/DAO/LocationsDAO.php';
require_once 'Library/DAO/DistanceDAO.php';

use App\Database\LocationsDAO;
use App\Database\DistanceDAO;
use App\Entities\Location;

if (!isset($_SESSION['user'])) {
    header("Location: login.php?err=404");
}

if (isset($_POST["fromSrc"]) && $_POST["destSrc"]) {
    // After searching, store the input into session
    $_SESSION['fromSrc'] = $_POST["fromSrc"];
    $_SESSION["destSrc"] = $_POST["destSrc"];
    $fromSrc = $_SESSION['fromSrc'];
    $destSrc = $_SESSION['destSrc'];

    // Search the locations by name
    $locationsFrom = LocationsDAO::Get_Location_By_Name($_POST["fromSrc"]);
    $locationsDest = LocationsDAO::Get_Location_By_Name($_POST["destSrc"]);
} 

// Process distance calculation on second form submission
if (isset($_POST["locationFrom"]) && isset($_POST["locationDest"])) {
    $_SESSION["locationFrom"] = $_POST["locationFrom"];
    $_SESSION["locationDest"] = $_POST["locationDest"];
    
    $distance = DistanceDAO::Get_Distance_By_Id($_POST["locationFrom"], $_POST["locationDest"]);
    $price = (10000 + ($distance * 3000));

    $_SESSION['distance'] = $distance;
    $_SESSION['price'] = $price;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeDoBu</title>
</head>

<body>
    <!-- First form to search locations -->
    <form action="order_debug.php" method="post">
        <label>Find location for your departure?</label>
        <br>
        <input type="text" name="fromSrc" id="from" value="<?php echo isset($fromSrc) ? $fromSrc : ''; ?>">
        <br>
        <label>Where is your destination?</label>
        <br>
        <input type="text" name="destSrc" id="destination" value="<?php echo isset($destSrc) ? $destSrc : ''; ?>">
        <br>
        <label>Check Your Price</label>
        <input type="submit">
    </form>

    <!-- Display location options after search -->
    <?php if (isset($locationsFrom) && isset($locationsDest)) : ?>
        <form action="order_debug.php" method="post">
            <label>Select departure location:</label>
            <select name="locationFrom">
                <?php
                foreach ($locationsFrom as $locationFrom) {
                    echo '<option value="' . $locationFrom->getId() . '">' . $locationFrom->__toString() . '</option>';
                }
                ?>
            </select>
            <br>
            <label>Select destination location:</label>
            <select name="locationDest">
                <?php
                foreach ($locationsDest as $locationDest) {
                    echo '<option value="' . $locationDest->getId() . '">' . $locationDest->__toString() . '</option>';
                }
                ?>
            </select>
            <br>
            <input type="submit" value="Calculate Price">
        </form>
    <?php endif; ?>

    <!-- Display the calculated price if set -->
    <?php if (isset($_SESSION['price'])) : ?>
    <?php 
    // Fetch locations from the database
    $locationFrom = LocationsDAO::Get_Location_By_Id($_SESSION['locationFrom']);
    $locationDest = LocationsDAO::Get_Location_By_Id($_SESSION['locationDest']);
    ?>

    <?php if ($locationFrom && $locationDest) : ?>
        <h2>From: <?php echo $locationFrom->__toString(); ?></h2>
        <h2>Destination: <?php echo $locationDest->__toString(); ?></h2>
        <h3>Distance: <?php echo $_SESSION['distance']; ?> km</h3>
        <h3>Price: <?php echo number_format($_SESSION['price'], 0, ',', '.'); ?> IDR</h3>
    <?php else : ?>
        <p>Sorry, one of the locations could not be found.</p>
    <?php endif; ?>
<?php endif; ?>
</body>

</html>
