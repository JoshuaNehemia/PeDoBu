<?php
namespace App\Entities;

class Order {
    private $id;
    private $orderDate;
    private $madeTime;
    private $finishTime;
    private $usersUsername;
    private $driversUsername;
    private $distanceFrom;
    private $distanceDestination;

    public function __construct($id, $orderDate, $madeTime, $finishTime, $usersUsername, $driversUsername, $distanceFrom, $distanceDestination) {
        $this->setId($id);
        $this->setOrderDate($orderDate);
        $this->setMadeTime($madeTime);
        $this->setFinishTime($finishTime);
        $this->setUsersUsername($usersUsername);
        $this->setDriversUsername($driversUsername);
        $this->setDistanceFrom($distanceFrom);
        $this->setDistanceDestination($distanceDestination);
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setOrderDate($orderDate) { $this->orderDate = $orderDate; }
    public function getOrderDate() { return $this->orderDate; }

    public function setMadeTime($madeTime) { $this->madeTime = $madeTime; }
    public function getMadeTime() { return $this->madeTime; }

    public function setFinishTime($finishTime) { $this->finishTime = $finishTime; }
    public function getFinishTime() { return $this->finishTime; }

    public function setUsersUsername($usersUsername) { $this->usersUsername = $usersUsername; }
    public function getUsersUsername() { return $this->usersUsername; }

    public function setDriversUsername($driversUsername) { $this->driversUsername = $driversUsername; }
    public function getDriversUsername() { return $this->driversUsername; }

    public function setDistanceFrom($distanceFrom) { $this->distanceFrom = $distanceFrom; }
    public function getDistanceFrom() { return $this->distanceFrom; }

    public function setDistanceDestination($distanceDestination) { $this->distanceDestination = $distanceDestination; }
    public function getDistanceDestination() { return $this->distanceDestination; }
}
