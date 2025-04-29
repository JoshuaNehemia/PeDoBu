<?php
die("OK");
// Aktifkan error reporting untuk melihat semua kesalahan
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

// Pastikan Library/Security/Security.php tersedia
if (!file_exists('Library/Security/Security.php')) {
    die("File Security.php tidak ditemukan!");
}
require_once 'Library/Security/Security.php';
use App\Security\Security;

// Cek apakah fungsi OpenSSL tersedia
if (!function_exists('openssl_encrypt')) {
    die("Fungsi OpenSSL tidak tersedia di server PHP ini!");
}

// Debug: Cek versi OpenSSL
echo "OpenSSL versi: " . OPENSSL_VERSION_TEXT . "<br>";

// Password yang akan diuji
$passwordInput = "d"; 

// Debugging sebelum enkripsi
error_log("Memulai enkripsi untuk password: " . $passwordInput);
echo "Memulai enkripsi...<br>";

// Enkripsi password
$encryptedPassword = Security::encrypt($passwordInput);

// Debugging setelah enkripsi
error_log("Password setelah enkripsi: " . $encryptedPassword);
echo "Password setelah enkripsi: " . $encryptedPassword . "<br>";

// Dekripsi password
$decryptedPassword = Security::decrypt($encryptedPassword);

// Debugging setelah dekripsi
error_log("Password setelah dekripsi: " . $decryptedPassword);
echo "Password setelah dekripsi: " . $decryptedPassword . "<br>";

// Final Debugging: Periksa hasilnya di file error log
echo "<br>Silakan cek file 'php_errors.log' jika ada masalah.<br>";
?>
