<?php
require_once 'Library/Entities/User.php';

require_once 'Library/DAO/UserDAO.php';

use App\Entities\User;
use App\Database\UserDAO;

session_start();

if (isset($_POST['userName'], $_POST['password'], $_POST['fullName'], $_POST['phoneNumber'])) {
    $User = new User($_POST['userName'], $_POST['password'], $_POST['fullName'], $_POST['phoneNumber'], balance: 0, securityPin: '000000');
    $res = UserDAO::Insert_User_SignUp($User);
    if ($res) {
        $_SESSION['user'] = $User;
        header('Location: home.php');
    } else {
        header('Location: register.php?err=001');
    }

    exit();
} else {
    header('Location: register.php?err=404');
    exit();
}