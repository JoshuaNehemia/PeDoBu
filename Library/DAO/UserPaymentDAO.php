<?php
namespace App\Database;

require_once __DIR__ . '/Database.php';

use App\Database\Database;

class UsersPaymentDAO
{
    public static function Insert($orderId, $price, $paymentTime)
    {
        $id = UsersPaymentDAO::Get_Id();
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO userspayment (id, orders_id, price, paymentTime) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iids", $id, $orderId, $price, $paymentTime);
        return $stmt->execute();
    }

    private static function Get_Id()
    {
        $conn = Database::getConnection();
    
        error_log("Attempting getting order data id: ");
    
        $stmt = $conn->prepare("SELECT id FROM userspayment ORDER BY id DESC LIMIT 1");
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        if ($result && $row = $result->fetch_assoc()) {
            return $row['id'] + 1;
        } else {
            return 1;
        }
    }

    public static function Select_By_Orders_Id($orderId)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM userspayment WHERE orders_id = ?");
        $stmt->bind_param("i", $orderId);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row;
        }
        return null;
    }
}
?>
