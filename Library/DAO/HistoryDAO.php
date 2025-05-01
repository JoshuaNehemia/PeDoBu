<?php
namespace App\Database;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../Entities/Order.php';
require_once __DIR__ . '/../Security/Security.php';

use App\Database\Database;
use App\Security\Security;

class HistoryDAO
{

    public static function Select_Orders_By_Users_Username($username)
    {
        $conn = Database::getConnection();
    
        $stmt = $conn->prepare("SELECT id FROM orders WHERE users_username = ?;
        ");
    
        $stmt->bind_param("s", $username);
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row['id'];
        }
    
        return $orders;
    }

}
?>