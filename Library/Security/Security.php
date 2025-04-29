<?php
namespace App\Security;

class Security {
    private static string $rawKey = "ini32karakterkunciuntuktugaskampus123";
    private static string $cipherMethod = "AES-256-CBC";

    private static function getEncryptionKey(): string {
        return hash('sha256', self::$rawKey, true);
    }

    public static function encrypt($data): string {
        $ivLength = openssl_cipher_iv_length(self::$cipherMethod);
        $iv = openssl_random_pseudo_bytes($ivLength);
        
        $key = self::getEncryptionKey();
        $encrypted = openssl_encrypt($data, self::$cipherMethod, $key, OPENSSL_RAW_DATA, $iv);
        
        // Gabungkan IV dengan data terenkripsi sehingga saat dekripsi IV dapat diambil kembali
        return base64_encode($iv . $encrypted);
    }

    public static function decrypt($encryptedData): string|false {
        $raw = base64_decode($encryptedData);
        $ivLength = openssl_cipher_iv_length(self::$cipherMethod);

        if (strlen($raw) < $ivLength) {
            error_log("Decryption failed: IV not found");
            return false;
        }

        $iv = substr($raw, 0, $ivLength);
        $encrypted = substr($raw, $ivLength);
        
        $key = self::getEncryptionKey();
        return openssl_decrypt($encrypted, self::$cipherMethod, $key, OPENSSL_RAW_DATA, $iv);
    }
}
?>
