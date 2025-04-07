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
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Orders ID
    public function getOrdersId(): int
    {
        return $this->ordersId;
    }

    public function setOrdersId(int $ordersId): void
    {
        $this->ordersId = $ordersId;
    }

    // Fare
    public function getFare(): float
    {
        return $this->fare;
    }

    public function setFare(float $fare): void
    {
        $this->fare = $fare;
    }

    // Paid Time
    public function getPaidTime(): \DateTime
    {
        return $this->paidTime;
    }

    public function setPaidTime(string $paidTime): void
    {
        $this->paidTime = $paidTime;
    }
}
