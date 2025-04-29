<?php
session_start();

require_once __DIR__ . '/Library/DAO/UserDAO.php';
require_once __DIR__ . '/Library/Entities/User.php';
require_once __DIR__ . '/Library/Security/Security.php';

use App\Database\UserDAO;
use App\Entities\User;

if (isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $user = UserDAO::Get_User_Login($username, $password);
    
    if ($user !== null) {
        $_SESSION['user'] = [
            'username'    => $user->getUsername(),
            'fullName'    => $user->getFullName(),
            'phoneNumber' => $user->getPhoneNumber(),
            'balance'     => $user->getBalance()
        ];
        header('Location: home.php');
    } else {
        header('Location: login.php?err=1');
    }
    exit();
} else {
    header('Location: login.php?err=404');
    exit();
}
?>
