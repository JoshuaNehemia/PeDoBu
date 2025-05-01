<?php
namespace App\Database;

require_once 'Database.php';
require_once __DIR__ . '/../../Assets/DBphp/RepoTemp.php';

use App\Database\Database;
use mysqli_sql_exception;

Class BalanceDAO
{
    public static function Update_User_Balance($username, $amount)
    {

        $conn = Database::getConnection();

        $stmt = $conn->prepare("UPDATE users SET balance = balance + ? WHERE username = ?");
        $stmt->bind_param("ds", $amount, $username);
        $stmt->execute();

    }

    public static function Update_Driver_Balance($username, $amount)
    {

        $connection = new Database();
        $conn = $connection->getConnection();

        $stmt = $conn->prepare("UPDATE driversSET balance = balance + ? WHERE username = ?");
        $stmt->bind_param("ds", $amount, $username);
        $stmt->execute();

    }
}