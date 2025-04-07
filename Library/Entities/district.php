<?php
namespace App\Entities;

class District {
    private $id;
    private $name;
    private $city; // type: City

    public function __construct($id, $name, City $city) {
        $this->setId($id);
        $this->setName($name);
        $this->setCity($city);
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }

    public function setCity(City $city) { $this->city = $city; }
    public function getCity() { return $this->city; }
}
