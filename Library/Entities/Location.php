<?php
namespace App\Entities;

class Location
{
    private $id;
    private $name;
    private $numbers;
    private $street;
    private $district; //Name
    private $city; //Name
    private $province; //Name

    public function __construct($id, $name, $numbers, $street, $district, $city, $province)
    {
        $this->id = $id;
        $this->name = $name;
        $this->numbers = $numbers;
        $this->street = $street;
        $this->district = $district;
        $this->city = $city;
        $this->province = $province;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNumbers()
    {
        return $this->numbers;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getProvince()
    {
        return $this->province;
    }

    // Setters
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setNumbers($numbers): void
    {
        $this->numbers = $numbers;
    }

    public function setstreetId($street): void
    {
        $this->street = $street;
    }

    public function __toString()
    {
        $message = $this->getName() . ', ' .
                   $this->getStreet() . ', ' .
                   $this->getNumbers() . ', ' .
                   $this->getDistrict() . ', ' .
                   $this->getCity() . ', ' .
                   $this->getProvince();
    
        return $message;
    }
}
