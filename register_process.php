<?php
require_once 'Library/Entities/User.php';
use App\Entities\User;
session_start();

if (isset($_POST['userName'], $_POST['password'], $_POST['fullName'], $_POST['phoneNumber'])) {
    //Check Insert User di Database kalau ada gabisa masuk

    $User = new User($_POST['userName'], $_POST['password'], $_POST['fullName'], $_POST['phoneNumber'],balance: 0,securityPin: '000000');
    
    $_SESSION['User'] = $User;
    // Add user to database
    header('Location: home.php');
    exit();
} else {
    header('Location: register.php?err=1');
    exit();
}