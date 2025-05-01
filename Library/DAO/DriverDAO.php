<?php
namespace App\Database;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../Entities/Drivers.php';
require_once __DIR__ . '/../Security/Security.php';

use App\Database\Database;
use App\Entities\Driver;
use App\Security\Security;

class DriverDAO {
// Proses registrasi driver: enkripsi password dan idNumber sebelum insert ke database
public static function Insert_Driver_SignUp(Driver $driver): bool {
    $conn = Database::getConnection();

    // Cek apakah username sudah ada
    $username = $driver->getUsername();
    $checkStmt = $conn->prepare("SELECT username FROM drivers WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkStmt->store_result();
    if ($checkStmt->num_rows > 0) {
        return false; // Username sudah digunakan
    }

    // Enkripsi password dan idNumber sebelum penyimpanan
    $rawPassword = $driver->getPassword();
    $encryptedPassword = Security::encrypt($rawPassword);
    $rawIdNumber = $driver->getIdNumber();
    $encryptedIdNumber = Security::encrypt($rawIdNumber);

    error_log("Password before encryption: " . $rawPassword);
    error_log("Password after encryption: " . $encryptedPassword);
    error_log("ID Number before encryption: " . $rawIdNumber);
    error_log("ID Number after encryption: " . $encryptedIdNumber);

    // Persiapkan query INSERT sesuai struktur tabel:
    // (username, email, password, phoneNumber, idNumber, licenceNumber, plateNumber, driverType)
    $stmt = $conn->prepare("INSERT INTO drivers (username, email, password, phoneNumber, idNumber, licenceNumber, plateNumber, driverType) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Konversi phoneNumber menjadi double
    $phone = (double)$driver->getPhoneNumber();

    // Binding parameter: format "sssdssss"
    $stmt->bind_param(
        "sssdssss",
        $username,
        $driver->getEmail(),
        $encryptedPassword,
        $phone,
        $encryptedIdNumber,
        $driver->getLicenceNumber(),
        $driver->getPlateNumber(),
        $driver->getDriverType()
    );
    return $stmt->execute();
}

// Proses login driver: ambil data driver dari database, dekripsi password, dan verifikasi
public static function Get_Driver_Login($username, $password) {
    $conn = Database::getConnection();
    
    error_log("Attempting login for driver username: " . $username);
    $stmt = $conn->prepare("SELECT * FROM drivers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $row = $result->fetch_assoc()) {
        // Ambil password terenkripsi dari database
        $encryptedPassword = $row['password'];
        error_log("Encrypted password from DB: " . $encryptedPassword);
        $decryptedPassword = Security::decrypt($encryptedPassword);
        
        // Jika dekripsi gagal, gunakan nilai yang tersimpan
        if ($decryptedPassword === false) {
            error_log("Decryption failed; using stored password as is.");
            $decryptedPassword = $encryptedPassword;
        }
        error_log("Decrypted password: " . $decryptedPassword);
        error_log("Input password: " . $password);

        if ($password === $decryptedPassword) {
            // Proses dekripsi untuk idNumber juga jika diperlukan
            $encryptedIdNumber = $row['idNumber'];
            $decryptedIdNumber = Security::decrypt($encryptedIdNumber);
            if ($decryptedIdNumber === false) {
                $decryptedIdNumber = $encryptedIdNumber;
            }
            error_log("Decrypted idNumber: " . $decryptedIdNumber);

            return new Driver(
                $row['id'],
                $row['fullName'],
                $row['email'],
                $encryptedPassword,  // Simpan password terenkripsi dalam objek jika diperlukan
                (float)$row['phoneNumber'],
                $decryptedIdNumber,
                $row['licenceNumber'],
                $row['plateNumber'],
                $row['driverType']
            );
        } else {
            error_log("Password mismatch for username: " . $username);
        }
    } else {
        error_log("Driver not found for username: " . $username);
    }
    return null;
}
//Kutambahin
public static function Select_Driver_By_Id($username) {
    $conn = Database::getConnection();

    error_log("Fetching driver data for username: " . $username);
    $stmt = $conn->prepare("SELECT * FROM drivers WHERE id = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $encryptedPassword = $row['password'];
        $encryptedIdNumber = $row['idNumber'];

        $decryptedIdNumber = Security::decrypt($encryptedIdNumber);
        if ($decryptedIdNumber === false) {
            $decryptedIdNumber = $encryptedIdNumber;
        }

        return new Driver(
            $row['id'],
            $row['fullName'],
            $row['email'],
            $encryptedPassword, // still storing encrypted
            (float)$row['phoneNumber'],
            $decryptedIdNumber,
            $row['licenceNumber'],
            $row['plateNumber'],
            $row['driverType']
        );
    } else {
        error_log("No driver found with username: " . $username);
        return null;
    }
}

}
?>
