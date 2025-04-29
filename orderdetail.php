<?php
require_once __DIR__ . '/Library/Entities/Order.php';
require_once __DIR__ . '/Library/DAO/OrderDAO.php';
require_once __DIR__ . '/Library/DAO/UserDAO.php';
require_once __DIR__ . '/Library/DAO/BalanceDAO.php';
require_once __DIR__ . '/Library/DAO/LocationsDAO.php';
require_once __DIR__ . '/Library/DAO/DriverDAO.php';

use App\Database\DriverDAO;
use App\Entities\Location;
use App\Entities\User;
use App\Entities\Order;
use App\Database\OrderDAO;
use App\Database\LocationsDAO;

session_start();

// Check if user_order is set in session before proceeding
if (isset($_SESSION['user_order'])) {
  $from = $_SESSION['user_order']['from'];
  $to = $_SESSION['user_order']['destination'];

  // Get locations for display
  $fromDisplay = LocationsDAO::Get_Location_By_Id($from);
  $destinationDisplay = LocationsDAO::Get_Location_By_Id($to);

  // Make sure location data is returned
  if ($fromDisplay && $destinationDisplay) {
    $fromDisplay = $fromDisplay->__toString();
    $destinationDisplay = $destinationDisplay->__toString();
  } else {
    // Handle invalid location retrieval
    $fromDisplay = "Unknown location";
    $destinationDisplay = "Unknown location";
  }

  // Get the order data by ID
  $userOrder = OrderDAO::Select_Order_By_Id($_SESSION['user_order']['id']);

  // Ensure the order was retrieved
  if ($userOrder) {
    $_SESSION['user_order'] = [
      'id' => $userOrder->getId(),
      'orderDate' => $userOrder->getOrderDate(),
      'madeTime' => $userOrder->getMadeTime(),
      'finishTime' => $userOrder->getFinishTime(),
      'username' => $userOrder->getUsersUsername(),
      'driverId' => $userOrder->getDriversUsername(),
      'from' => $userOrder->getDistanceFrom(),
      'destination' => $userOrder->getDistanceDestination()
    ];
    $idInvoice = $userOrder->getId();
    if ($userOrder->getDriversUsername() !== 1) {
      $driver = DriverDAO::Select_Driver_By_Id($userOrder->getDriversUsername());
    }
  } else {
    // Handle the case where the order is not found
    echo "Order not found.";
    exit;
  }

} else {
  // Handle the case where user_order is not set in session
  echo "Order data is not available.";
  exit;
}

// Set header to refresh page after 15 seconds
header("Refresh: 15");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Detail</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'DM Sans', sans-serif;
      display: flex;
      overflow-x: hidden;
    }

    H1 {
      color: #006400;
    }

    span {
      background: #ddd;
      padding: 8px 10px;
      border-radius: 30px;
      font-size: 15px;
      margin-left: 5px;
    }

    .sidebar {
      width: 80px;
      background-color: #F8F8F8;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      padding: 20px 0;
      border-right: 2px solid #4CAF50;
      position: fixed;
      height: 100vh;
      left: 0;
      top: 0;
      z-index: 1000;
    }

    .sidebar .top-section,
    .sidebar .middle-section,
    .sidebar .bottom-section {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .sidebar button {
      background: none;
      border: none;
      margin: 10px 0;
      cursor: pointer;
    }

    .sidebar img {
      width: 40px;
      height: 40px;
    }

    .main-content {
      margin-left: 80px;
      display: flex;
      height: 100vh;
      width: calc(100% - 80px);
    }

    .left-content {
      width: 40%;
      padding: 30px;
      background-color: #ffffff;
      overflow-y: auto;
    }

    .right-map {
      width: 60%;
      height: 100%;
    }

    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    .driver-card {
      border: 1px solid #ccc;
      border-radius: 12px;
      padding: 15px;
      margin: 20px 0;
    }

    .driver-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .driver-info {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .driver-info img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }

    .location-box {
      border: 1px solid #ccc;
      border-radius: 12px;
      padding: 20px;
      margin-top: 20px;
    }

    .location-box p {
      margin: 10px 0;
    }

    .print-button {
      margin-top: 20px;
      padding: 10px 20px;
      border: 2px solid green;
      background-color: white;
      border-radius: 10px;
      font-weight: bold;
      cursor: pointer;
      color: green;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="top-section">
      <img src="assets/images/LogoPedoBu.png" alt="Logo">
    </div>
    <div class="middle-section">
      <button onclick="location.href='home.php'"><img src="assets/images/homeRedup.png" alt="Home"></button>
      <button onclick="location.href='order.php'"><img src="assets/images/LogoMotor.png" alt="Order"></button>
      <button onclick="location.href='history.php'"><img src="assets/images/LogoHistory.png" alt="History"></button>
      <button onclick="location.href='profile.php'"><img src="assets/images/LogoProfile.png" alt="Profile"></button>
    </div>
    <div class="bottom-section">
      <button onclick="location.href='driverLogin.php'"><img src="assets/images/LogoLogOut.png" alt="Logout"></button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Left Panel -->
    <div class="left-content">
      <h1>ORDER</h1>
      <span>Motorcycle</span>

      <div class="driver-card">
        <div class="driver-header"
          style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <strong>DRIVER</strong>
          <div style="display: flex; align-items: center; gap: 10px;">
            <a href="#" style="color: red; font-size: 14px;">Report</a>
            <img src="assets/images/logochat.png" alt="Chat" style="width: 40px; height: 40px;">
            <img src="assets/images/logotelp.png" alt="Phone" style="width: 40px; height: 40px;">
          </div>
        </div>
        <?php
        if ($userOrder->getDriversUsername() == 1) {
          echo '
            
        <div class="driver-info">
          <img src="assets/images/waiting.png" alt="waiting">
          <div>
            <strong>Waiting for driver</strong><br>
            Looking for driver!<br>
            Please be patient.
          </div>
        </div>
            
            ';
        } else {

          echo '
        <div class="driver-info">
          <img src="assets/images/drivergojek.jpg" alt="driver_face">
          <div>
            <strong>' . $driver->getFullName() . '</strong><br>
            ' . $driver->getPlateNumber() . '<br>
            Please enjoy your ride!
          </div>
        </div>
    ';
        }
        ?>
      </div>


      <h1>Your order</h1>
      <div class="location-box">
        <p><strong>🧭 Pickup:</strong><br><?php echo htmlspecialchars($fromDisplay); ?></p>
        <hr>
        <p><strong>📍 Destination:</strong><br><?php echo htmlspecialchars($destinationDisplay); ?></p>
        <?php
        if (isset($driver)) {
          if ($driver->getUsername() !== 1) {
            echo "<br><a href=\"Invoice/invoice.php?order_id={$idInvoice}\" class=\"print-button\">Print Order</a>";
          }
        }
        ?>
      </div>
    </div>

    <!-- Right Map -->
    <div class="right-map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d3957.407030538748!2d112.77860507582144!3d-7.309835672206315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x2dd7fbd0b2d125ab%3A0xc8534b0a3b89a715!2sJl.%20Kedinding%20Lor%20II%20No%205%2C%20Surabaya!3m2!1d-7.311205!2d112.782338!4m5!1s0x2dd7fbca0799535f%3A0xf07a45a3065976f1!2sWarkop%20Indonesia%2C%20Jl.%20Kedung%20Cowek%20V%2C%20Surabaya!3m2!1d-7.308363!2d112.784958!5e0!3m2!1sen!2sid!4v1712717740000!5m2!1sen!2sid"
        allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</body>

</html>