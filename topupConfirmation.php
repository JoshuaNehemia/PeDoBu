<?php
session_start();

require_once __DIR__ . '/Library/Entities/user.php.php';
require_once __DIR__ . '/Library/DAO/BalanceDAO.php';
require_once __DIR__ . '/Library/DAO/UserDAO.php';

use App\Entities\User;
use App\Database\BalanceDAO;
use App\Database\UserDAO;

if(isset($_SESSION['user']) && isset($_POST['amount']))
{
    $user = $_SESSION['user'];
    $amount = $_POST['amount'];
    if($amount<0)
    {
        header('Location : topupProcess.php?err=1');
        exit();
    }
    BalanceDAO::Update_User_Balance($user['username'],$amount);
    $user = UserDAO::getUserByUsername($user['username']);
    $_SESSION['user'] = $user;
}
else{
    header('Location : index.php');
    exit();
}
?>