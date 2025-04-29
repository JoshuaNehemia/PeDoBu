<?php
namespace App\Entities;

require_once __DIR__ . '/../Security/Security.php';

use App\Security\Security;

class Driver {
    private string $username;
    private string $email;
    private string $password;
    private float $phoneNumber;
    private string $idNumber;
    private string $licenceNumber;
    private string $plateNumber;
    private string $driverType;

    public function __construct(
        string $username,
        string $email,
        string $password,
        float $phoneNumber,
        string $idNumber,
        string $licenceNumber,
        string $plateNumber,
        string $driverType
    ) {
        $this->setUsername($username);
        $this->setEmail($email);
        // Di registrasi awal, password dan idNumber diterima dalam bentuk plaintext.
        // Nantinya pada DAO, kedua field ini akan dienkripsi.
        $this->setPassword($password);
        $this->setPhoneNumber($phoneNumber);
        $this->setIdNumber($idNumber);
        $this->setLicenceNumber($licenceNumber);
        $this->setPlateNumber($plateNumber);
        $this->setDriverType($driverType);
    }

    // Method untuk verifikasi password saat login
    public function verifyPassword($inputPassword): bool {
        $decryptedPassword = Security::decrypt($this->password);
        error_log("Decrypted Password in verify: " . $decryptedPassword);
        return $decryptedPassword !== false && $inputPassword === $decryptedPassword;
    }

    // Setters
    public function setUsername(string $username): void { $this->username = $username; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function setPhoneNumber(float $phoneNumber): void { $this->phoneNumber = $phoneNumber; }
    public function setIdNumber(string $idNumber): void { $this->idNumber = $idNumber; }
    public function setLicenceNumber(string $licenceNumber): void { $this->licenceNumber = $licenceNumber; }
    public function setPlateNumber(string $plateNumber): void { $this->plateNumber = $plateNumber; }
    public function setDriverType(string $driverType): void { $this->driverType = $driverType; }

    // Getters
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getPhoneNumber(): float { return $this->phoneNumber; }
    public function getIdNumber(): string { return $this->idNumber; }
    public function getLicenceNumber(): string { return $this->licenceNumber; }
    public function getPlateNumber(): string { return $this->plateNumber; }
    public function getDriverType(): string { return $this->driverType; }
}
?>
