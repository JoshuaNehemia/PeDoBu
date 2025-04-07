<?php
namespace App\Entities;

class Driver extends User {
    public function __construct($username, $password, $fullName, $phoneNumber, $saldo, $securityPin) {
        parent::__construct($username, $password, $fullName, $phoneNumber, $saldo, $securityPin);
    }
}
?>
