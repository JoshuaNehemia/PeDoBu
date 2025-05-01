<?php
namespace App\Database;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../Entities/Order.php';
require_once __DIR__ . '/../Security/Security.php';

use App\Database\Database;
use App\Entities\Order;
use App\Security\Security;

class OrderDAO
{
    // Proses login: ambil data user dari database dan cek password hasil dekripsi
    public static function Insert_New_Order($orderDate, $madeTime, $username, $fromId, $destinationId)
{
    $id = OrderDAO::Get_Order_Id();
    $driverId = 1;
    $conn = Database::getConnection();

    error_log("Attempting getting order data for id: " . $id);

    $stmt = $conn->prepare("
        INSERT INTO orders 
        (`id`, `orderDate`, `madeTime`, `users_username`, `distance_from`, `distance_destination`, `drivers_id`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    // Corrected bind_param line
    $stmt->bind_param("isssiii", $id, $orderDate, $madeTime, $username, $fromId, $destinationId, $driverId);

    $stmt->execute();

    return new Order($id, $orderDate, $madeTime, null, $username, $driverId, $fromId, $destinationId);
}

public static function Select_Order_By_Id($id)
{
    $conn = Database::getConnection();

    $stmt = $conn->prepare("
        SELECT 
            id, 
            orderDate, 
            madeTime, 
            finishTime, 
            users_username, 
            drivers_id, 
            distance_from, 
            distance_destination 
        FROM orders 
        WHERE id = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        return new Order(
            $row['id'],
            $row['orderDate'],
            $row['madeTime'],
            $row['finishTime'],
            $row['users_username'],
            $row['drivers_id'],
            $row['distance_from'],
            $row['distance_destination']
        );
    } else {
        return null; // Order not found
    }
}

    private static function Get_Order_Id()
    {
        $conn = Database::getConnection();
    
        error_log("Attempting getting order data id: ");
    
        $stmt = $conn->prepare("SELECT id FROM orders ORDER BY id DESC LIMIT 1");
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        if ($result && $row = $result->fetch_assoc()) {
            return $row['id'] + 1;
        } else {
            return 1;
        }
    }

    public static function Select_Available_Orders($driverId)
    {
        return OrderDAO::Select_Order_By_Id(1);
        //Buat 1 akun driver yang ID nya 1 buat sebagai available , aku nge trick iki
    }
    
    public static function Select_Orders_By_Drivers_Id($driverId)
    {
        $conn = Database::getConnection();
    
        $stmt = $conn->prepare("
            SELECT 
                id, 
                orderDate, 
                madeTime, 
                finishTime, 
                users_username, 
                drivers_id, 
                distance_from, 
                distance_destination 
            FROM orders 
            WHERE drivers_id = ?
        ");
    
        $stmt->bind_param("i", $driverId);
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = new Order(
                $row['id'],
                $row['orderDate'],
                $row['madeTime'],
                $row['finishTime'],
                $row['users_username'],
                $row['drivers_id'],
                $row['distance_from'],
                $row['distance_destination']
            );
        }
    
        return $orders;
    }

    //Buat driver ngambil pesenan
    public static function Update_Order_Driver($orderId, $driverId)
{
    $conn = Database::getConnection();

    error_log("Updating driver_id for order ID: $orderId to driver ID: $driverId");

    $stmt = $conn->prepare("UPDATE orders SET drivers_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $driverId, $orderId);

    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Failed to update order: " . $stmt->error);
        return false;
    }
}

}
?>