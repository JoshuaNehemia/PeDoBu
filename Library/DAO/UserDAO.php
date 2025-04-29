<?php
namespace App\Database;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../Entities/User.php';
require_once __DIR__ . '/../Security/Security.php';

use App\Database\Database;
use App\Entities\User;
use App\Security\Security;

class UserDAO {
    // Proses registrasi: enkripsi password sebelum insert ke database
    public static function Insert_User_SignUp(User $user): bool {
        $conn = Database::getConnection();
        
        // Cek apakah username sudah ada
        $username = $user->getUsername();
        $checkStmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();
        if ($checkStmt->num_rows > 0) {
            return false; // Username sudah digunakan
        }
        
        // Enkripsi password sebelum menyimpan ke database
        $rawPassword = $user->getPassword();
        $encryptedPassword = Security::encrypt($rawPassword);

        error_log("Password before encryption: " . $rawPassword);
        error_log("Password after encryption: " . $encryptedPassword);

        $stmt = $conn->prepare("INSERT INTO users (username, password, fullName, phoneNumber, balance, securityPin) VALUES (?, ?, ?, ?, ?, ?)");
        $fullName = $user->getFullName();
        $phoneNumber = $user->getPhoneNumber();
        $balance = $user->getBalance();
        $securityPin = $user->getSecurityPin();

        // Gunakan format "ssssds" (string, string, string, string, double, string)
        $stmt->bind_param("ssssds", $username, $encryptedPassword, $fullName, $phoneNumber, $balance, $securityPin);
        return $stmt->execute();
    }

    // Proses login: ambil data user dari database dan cek password hasil dekripsi
    public static function Get_User_Login($username, $password) {
        $conn = Database::getConnection();
        
        error_log("Attempting login for username: " . $username);
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            // Dekripsi password dari database
            $encryptedPassword = $row['password'];
            $decryptedPassword = Security::decrypt($encryptedPassword);
            error_log("Decrypted password from database: " . $decryptedPassword);
            error_log("Input password: " . $password);

            if ($decryptedPassword !== false && $password === $decryptedPassword) {
                error_log("Login successful for user: " . $username);
                return new User(
                    $row['username'],
                    $encryptedPassword, // Simpan password terenkripsi dalam objek
                    $row['fullName'],
                    $row['phoneNumber'],
                    $row['balance'],
                    $row['securityPin']
                );
            } else {
                error_log("Wrong password or decryption error for user: " . $username);
            }
        } else {
            error_log("User not found for username: " . $username);
        }
        return null;
    }

    public static function getUserByUsername($username) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            return new User(
                $row['username'],
                $row['password'],
                $row['fullName'],
                $row['phoneNumber'],
                $row['balance'],
                $row['securityPin']
            );
        }
        return null;
    }
}
?>
