<?php
namespace App\Entities;

class OrderStatus {
    private $orderId;
    private $driversLocation;
    private $status;
    private $time;

    public function __construct($orderId, $driversLocation, $status, $time) {
        $this->setOrderId($orderId);
        $this->setDriversLocation($driversLocation);
        $this->setStatus($status);
        $this->setTime($time);
    }

    public function setOrderId($orderId) { $this->orderId = $orderId; }
    public function getOrderId() { return $this->orderId; }

    public function setDriversLocation($driversLocation) { $this->driversLocation = $driversLocation; }
    public function getDriversLocation() { return $this->driversLocation; }

    public function setStatus($status) { $this->status = $status; }
    public function getStatus() { return $this->status; }

    public function setTime($time) { $this->time = $time; }
    public function getTime() { return $this->time; }
}
