<?php

namespace App\Entities;

class Payment
{
    private $id;
    private $ordersId;
    private $fare;
    private $paidTime;

    public function __construct($id,$ordersId, $fare,$paidTime)
    {
        $this->setId($id);
        $this->setOrdersId($ordersId);
        $this->setFare($fare);
        $this->setPaidTime($paidTime);
    }

    // ID
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Orders ID
    public function getOrdersId()
    {
        return $this->ordersId;
    }

    public function setOrdersId($ordersId)
    {
        $this->ordersId = $ordersId;
    }

    // Fare
    public function getFare()
    {
        return $this->fare;
    }

    public function setFare($fare)
    {
        $this->fare = $fare;
    }

    // Paid Time
    public function getPaidTime()
    {
        return $this->paidTime;
    }

    public function setPaidTime($paidTime)
    {
        $this->paidTime = $paidTime;
    }
}
