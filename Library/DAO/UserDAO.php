<?php
namespace App\Database;

require_once 'Database.php';
require_once __DIR__ . '/../Entities/User.php';

use App\Database\Database;
use App\Entities\User;
use mysqli_sql_exception;

class UserDAO
{
    public static function Get_User_Login($username, $password)
    {   
        $connection = new Database();
        $conn = $connection->getConnection();

        error_log("Trying to log in" .$username);
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->Execute();
        $result = $stmt->get_result();
        
        // NOTE: Hash Passwordnya sebelum di proses

        if ($result && $row = $result->fetch_assoc()) {
            if ($password == $row['password']) {
                error_log("Log In Successful");
                return new User(
                    username: $row['username'],
                    password: $row['password'],
                    fullName: $row['fullname'],
                    phoneNumber: $row['phonenumber'],
                    balance: $row['balance'],
                    securityPin: $row['securitypin']
                );
            }
            else{
                error_log("Wrong username or password");
            }
        }
        else
        {
            
        } return null;
    }



    public static function Insert_User_SignUp($User)
    {
        $connection = new Database();
        $conn = $connection->getConnection();

        try {
            $stmt = $conn->prepare("
            INSERT INTO users (username, password, fullName, phoneNumber, balance, securityPin)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

            // NOTE: Hash Passwordnya sebelum di proses

            $stmt->bind_param("ssssds", 
            $User->getUsername(), 
            $User->getPassword(), 
            $User->getFullName(), 
            $User->getPhoneNumber(), 
            $User->getBalance(), 
            $User->getSecurityPin());
            $stmt->execute();

            $stmt->close();
            return true;
        } catch (mysqli_sql_exception $e) {
            error_log("Insert failed: " . $e->getMessage());
            return false;
        }
    }
}