<?php

require_once __DIR__ . '/Library/Entities/user.php';
require_once __DIR__ . '/Library/DAO/BalanceDAO.php';
require_once __DIR__ . '/Library/DAO/UserDAO.php';

session_start();

use App\Entities\User;
use App\Database\BalanceDAO;
use App\Database\UserDAO;

if(isset($_SESSION['user']) && isset($_POST['amount']))
{
    $user = $_SESSION['user'];
    $amount = $_POST['amount'];

    if ($amount < 0) {
        header('Location: topupProcess.php');
        exit();
    }

    BalanceDAO::Update_User_Balance($user['username'], $amount);
    $user = UserDAO::getUserByUsername($user['username']);
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

    header('Location: profile.php');
    exit();
}
else {
    header('Location: index.php');
    exit();
}

?>