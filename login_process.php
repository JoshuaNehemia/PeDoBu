<?php
require_once 'Library/Entities/User.php';

require_once 'Library/DAO/UserDAO.php';

use App\Entities\User;
use App\Database\UserDAO;

session_start();

if (isset($_POST['username'], $_POST['password'])) {
    $res = UserDAO::Get_User_Login($_POST['username'],$_POST['password']);
    if ($res !=null) {
        $_SESSION['user'] = $res;
        header('Location: home.php');
    } else {
        header('Location: login.php?err=1');
    }

    exit();
} else {
    header('Location: login.php?err=404');
    exit();
}