<?php
namespace App\Entities;

class Province {
    private $id;
    private $name;

    public function __construct($id, $name) {
        $this->setId($id);
        $this->setName($name);
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }
}
