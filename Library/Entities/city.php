<?php
namespace App\Entities;


class City {
    private $id;
    private $name;
    private $province;

    public function __construct($id, $name, Province $province) {
        $this->setId($id);
        $this->setName($name);
        $this->setProvince($province);
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }

    public function setProvince(Province $province) { $this->province = $province; }
    public function getProvince() { return $this->province; }
}
