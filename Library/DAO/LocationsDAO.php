<?php
namespace App\Database;

require_once 'Database.php';
require_once __DIR__ . '/../Entities/Location.php';
require_once __DIR__ . '/../../Assets/DBphp/RepoTemp.php';

use App\Database\Database;
use App\Entities\Location;
use mysqli_sql_exception;

class LocationsDAO
{
    public static function Get_Location_By_Name($name)
    {

        $connection = new Database();
        $conn = $connection->getConnection();

        $stmt = $conn->prepare("SELECT l.id, l.`name`, l.numbers, s.name as 'street', d.name as 'district', c.name as 'city', p.name as 'province'
FROM locations l
INNER JOIN streets s on s.id = l.streets_id
INNER JOIN districts d on d.id = s.districts_id
INNER JOIN city c on c.id = d.city_id
INNER Join province p on p.id = c.province_id
WHERE l.`name` like '%" . $name . "%';");
        $stmt->execute();
        $result = $stmt->get_result();

        $location = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $location[] = new Location(
                    $row['id'],
                    $row['name'],
                    $row['numbers'],
                    $row['street'],
                    $row['district'],
                    $row['city'],
                    $row['province'],
                );
            }
            error_log("Locations data retrieved successfully.");
            return $location;
        } else {
            error_log("Failed to retrieve locations.");
            return null;
        }
    }

    public static function Get_Location_By_Id($id)
    {
        $connection = new Database();
        $conn = $connection->getConnection();
    
        // Using a prepared statement to avoid SQL injection
        $stmt = $conn->prepare("
            SELECT 
                l.id, 
                l.`name`, 
                l.numbers, 
                s.name as 'street', 
                d.name as 'district', 
                c.name as 'city', 
                p.name as 'province'
            FROM locations l
            INNER JOIN streets s ON s.id = l.streets_id
            INNER JOIN districts d ON d.id = s.districts_id
            INNER JOIN city c ON c.id = d.city_id
            INNER JOIN province p ON p.id = c.province_id
            WHERE l.`id` = ?;");
    
        // Bind the parameter (the ID) to the prepared statement
        $stmt->bind_param("i", $id); // "i" denotes that the parameter is an integer
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            error_log("Location data retrieved successfully.");
            $row = $result->fetch_assoc();
    
            // Create and return a Location object
            $location = new Location(
                $row['id'],
                $row['name'],
                $row['numbers'],
                $row['street'],
                $row['district'],
                $row['city'],
                $row['province']
            );
            return $location;
        } else {
            error_log("Failed to retrieve location or no data found.");
            return null;
        }
    }
}    