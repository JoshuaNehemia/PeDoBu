<?php
namespace App\Database;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../Entities/Order.php';
require_once __DIR__ . '/../Security/Security.php';

use App\Database\Database;
use App\Entities\Order;
use App\Security\Security;

class InvoiceDAO
{
    // Proses login: ambil data user dari database dan cek password hasil dekripsi
    public static function Get_User_Login($id)
    {
        $conn = Database::getConnection();

        error_log("Attempting getting order data for id: " . $id);
        $stmt = $conn->prepare("SELECT 
    ord.id AS 'invoice_id',
    usr.fullName AS 'passenger',
    dri.username AS 'drivers_name',
    loc.name AS 'from',
    locd.name AS 'destination',
    distTab.distance AS 'distance',
    up.price AS 'charge'
FROM orders ord
INNER JOIN drivers dri ON ord.drivers_id = dri.id
INNER JOIN users usr ON ord.users_username = usr.username
INNER JOIN locations loc ON ord.distance_from = loc.id
INNER JOIN locations locd ON ord.distance_destination = locd.id
INNER JOIN userspayment up ON ord.id = up.orders_id
INNER JOIN (
    SELECT dist.from, dist.destination, dist.distance
    FROM distance dist
) AS distTab ON distTab.from = ord.distance_from AND distTab.destination = ord.distance_destination
WHERE ord.id = ?;
");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $invoice = [];
        if ($result && $row = $result->fetch_assoc()) {

            error_log("Invoice successful for ID: " . $id);
            return (
                $invoice = [
                    'invoice_id' => $row['invoice_id'],
                    'passenger' => $row['passenger'],
                    'driver_name' => $row['driver_name'],
                    'vin_number' => $row['vin_number'],
                    'from' => $row['from'],
                    'destination' => $row['destination'],
                    'distance' => $row['distance'],
                    'order_time' => $row['order_date'] . ' ' . $row['order_time'],
                    'charge' => $row['charge']
                ]
            );

        } else {
            error_log("Invoice not found for id: " . $id);
        }
        return null;
    }


}
?>