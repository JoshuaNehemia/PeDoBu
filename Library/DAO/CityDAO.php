<?php
namespace App\Database;

require_once 'Database.php';
require_once __DIR__ . '/../Entities/City.php';
require_once __DIR__ . '/../../Assets/DBphp/RepoTemp.php';

use App\Database\Database;
use App\Entities\City;
use App\Repository\RepoTemp;
use mysqli_sql_exception;

class CityDAO
{
    public static function Get_City_Data()
    {
        $connection = new Database();
        $conn = $connection->getConnection();
    
        $stmt = $conn->prepare('SELECT * FROM city;');
        $stmt->execute();
        $result = $stmt->get_result();
    
        $cities = [];
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $cities[] = new City(
                    $row['id'],
                    $row['name'],
                    $row['province_id'] 
                );
            }
    
            error_log("Cities data retrieved successfully.");
            RepoTemp::$cities = $cities;
        } else {
            error_log("Failed to retrieve city data.");
            return null;
        }
    }

}