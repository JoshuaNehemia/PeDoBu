<?php
session_start();

require_once __DIR__ . '/Library/Entities/User.php';
require_once __DIR__ . '/Library/DAO/UserDAO.php';

use App\Entities\User;
use App\Database\UserDAO;

if (isset($_POST['username'], $_POST['password'], $_POST['fullName'], $_POST['phoneNumber'])) {
    $username    = trim($_POST['username']);
    $password    = trim($_POST['password']);
    $fullName    = trim($_POST['fullName']);
    $phoneNumber = trim($_POST['phoneNumber']);
    
    // Buat objek User dengan balance awal 0 dan security pin default '000000'
    $newUser = new User(
        $username,
        $password,
        $fullName,
        $phoneNumber,
        0.0,
        '000000'
    );
    
    $result = UserDAO::Insert_User_SignUp($newUser);
    
    if ($result) {
        // Simpan data user ke session sebagai array (untuk menghindari masalah __PHP_Incomplete_Class)
        $_SESSION['user'] = [
            'username'    => $newUser->getUsername(),
            'fullName'    => $newUser->getFullName(),
            'phoneNumber' => $newUser->getPhoneNumber(),
            'balance'     => $newUser->getBalance()
        ];
        header('Location: home.php');
    } else {
        header('Location: register.php?err=001');
    }
    exit();
} else {
    header('Location: register.php?err=404');
    exit();
}
?>
