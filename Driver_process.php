<?php
session_start();

require_once __DIR__ . '/Library/Entities/Drivers.php';
require_once __DIR__ . '/Library/DAO/DriverDAO.php';
require_once __DIR__ . '/Library/Security/Security.php';

use App\Entities\Driver;
use App\Database\DriverDAO;

if (
    isset($_POST['username'], $_POST['email'], $_POST['password'],
        $_POST['phoneNumber'], $_POST['id_number'],
        $_POST['license_number'], $_POST['plate_number'],
        $_POST['driver_type'])
) {
    $username      = trim($_POST['username']);
    $email         = trim($_POST['email']);
    $password      = trim($_POST['password']);
    $phoneNumber   = (float)trim($_POST['phoneNumber']);
    $idNumber      = trim($_POST['id_number']);
    $licenceNumber = trim($_POST['license_number']);
    $plateNumber   = trim($_POST['plate_number']);
    $driverType    = trim($_POST['driver_type']);

    // Buat objek Driver dengan data dari form
    $newDriver = new Driver(
        $username,
        $email,
        $password,
        $phoneNumber,
        $idNumber,
        $licenceNumber,
        $plateNumber,
        $driverType
    );

    $result = DriverDAO::Insert_Driver_SignUp($newDriver);

    if ($result) {
        $_SESSION['driver'] = [
            'username'   => $username,
            'email'      => $email,
            'driverType' => $driverType
        ];
        header('Location: driver_dashboard.php');
    } else {
        header('Location: driverRegis.php?err=001');
    }
    exit();
} else {
    header('Location: driverRegis.php?err=404');
    exit();
}
?>
