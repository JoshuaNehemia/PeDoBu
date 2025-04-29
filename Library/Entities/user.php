<?php
namespace App\Entities;

require_once __DIR__ . '/../Security/Security.php';

use App\Security\Security;

class User {
    private string $username;
    private string $password;
    private string $fullName;
    private string $phoneNumber;
    private float $balance;
    private string $securityPin;

    public function __construct(string $username, string $password, string $fullName, string $phoneNumber, float $balance, string $securityPin) {
        $this->setUsername($username);
        // Pada proses registrasi, password masih berupa plaintext.
        // Nanti di UserDAO kita enkripsi password tersebut sebelum menyimpannya.
        $this->setPassword($password); 
        $this->setFullName($fullName);
        $this->setPhoneNumber($phoneNumber);
        $this->setBalance($balance);
        $this->setSecurityPin($securityPin);
    }

    // Method untuk verifikasi password pada saat login (menggunakan dekripsi)
    public function verifyPassword($inputPassword): bool {
        $decryptedPassword = Security::decrypt($this->password);
        error_log("Decrypted Password in verify: " . $decryptedPassword);
        return $decryptedPassword !== false && $inputPassword === $decryptedPassword;
    }

    // Setters
    public function setUsername(string $username): void { $this->username = $username; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function setFullName(string $fullName): void { $this->fullName = $fullName; }
    public function setPhoneNumber(string $phoneNumber): void { $this->phoneNumber = $phoneNumber; }
    public function setBalance(float $balance): void { $this->balance = $balance; }
    public function setSecurityPin(string $securityPin): void { $this->securityPin = $securityPin; }

    // Getters
    public function getUsername(): string { return $this->username; }
    public function getPassword(): string { return $this->password; }
    public function getFullName(): string { return $this->fullName; }
    public function getPhoneNumber(): string { return $this->phoneNumber; }
    public function getBalance(): float { return $this->balance; }
    public function getSecurityPin(): string { return $this->securityPin; }
}
?>
