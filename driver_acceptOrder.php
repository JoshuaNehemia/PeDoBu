<?php
session_start();

require_once __DIR__ . '/Library/DAO/OrderDAO.php';
require_once __DIR__ . '/Library/Entities/Drivers.php';
require_once __DIR__ . '/Library/DAO/DriverDAO.php';

use App\Database\OrderDAO;
use App\Entities\Driver;
use App\Database\DriverDAO;

// Debug: Show username
echo "Logged in driver: " . $_SESSION['driver']['username'] . "<br>";

if (isset($_SESSION['driver']['username'], $_SESSION['orderdrivermaunerimajangandipakaiini'])) {
    $username = $_SESSION['driver']['username'];
    $orderId = $_SESSION['orderdrivermaunerimajangandipakaiini'];

    // Get Driver object
    $driver = DriverDAO::Select_Driver_By_Id($username);
    if ($driver === null) {
        echo "Driver not found.";
        exit;
    }

    $driverId = $driver->getUsername();

    echo $driver->getUsername();

    // Update order with driver ID
    if (OrderDAO::Update_Order_Driver($orderId, $driverId)) {
        echo "Order accepted successfully.";
        header("Location: driver_arrived.php");
    } else {
        echo "Failed to accept the order.";
    }

} else {
    echo "Missing driver username or order ID.";
}
?>
