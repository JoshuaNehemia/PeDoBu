<?php
namespace App\Entities;
class User {
    private $username;
    private $password;
    private $fullName;
    private $phoneNumber;
    private $balance;
    private $securityPin;

    public function __construct($username, $password, $fullName, $phoneNumber, $balance, $securityPin) {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setFullName($fullName);
        $this->setPhoneNumber($phoneNumber);
        $this->setBalance($balance);
        $this->setSecurityPin($securityPin);
    }
    // Setters
    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function setBalance($balance) {
        $this->balance = $balance;
    }

    public function setSecurityPin($securityPin) {
        $this->securityPin = $securityPin;
    }

    // Getters
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getSecurityPin() {
        return $this->securityPin;
    }
}
?>
