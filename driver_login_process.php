<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/Library/Entities/Drivers.php';
require_once __DIR__ . '/Library/DAO/DriverDAO.php';
require_once __DIR__ . '/Library/Security/Security.php';

use App\Database\DriverDAO;

if (isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    error_log("Login process initiated for: " . $username);
    
    $driver = DriverDAO::Get_Driver_Login($username, $password);
    
    if ($driver !== null) {
        error_log("Login successful for: " . $driver->getUsername());
        $_SESSION['driver'] = [
            'username' => $driver->getUsername(),
            'email' => $driver->getEmail(),
            'driverType' => $driver->getDriverType()
        ];
        header('Location: driver_dashboard.php');
        exit();
    } else {
        error_log("Login failed for: " . $username);
        header('Location: driverLogin.php?err=1');
        exit();
    }
} else {
    header('Location: driverLogin.php?err=404');
    exit();
}
?>
