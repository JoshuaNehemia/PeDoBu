<?php
namespace App\Database;

require_once 'Database.php';
require_once __DIR__ . '/../../Assets/DBphp/RepoTemp.php';

use App\Database\Database;
use mysqli_sql_exception;

class DistanceDAO
{
    public static function Get_Distance_By_Id($from,$destination)
    {

        $connection = new Database();
        $conn = $connection->getConnection();

        $stmt = $conn->prepare("SELECT d.`distance`
FROM distance d
WHERE `from` = '" .$from ."' and `destination` = '" .$destination ."';");
        $stmt->execute();
        $result = $stmt->get_result();

        $distance = 0;

        if ($result) {
            if ($row = $result->fetch_assoc()) {
                $distance = $row["distance"];
                
            }
            error_log("distance data retrieved successfully.");
            return $distance;
        } else {
            error_log("distance to retrieve locations.");
            return null;
        }
    }
}