<?php
namespace App\Entities;

class Distance {
    private $from; 
    private $destination;   
    private $distanceInKm; //in KM 
    // titip rename jadi distance aja aku mager

    public function __construct(Street $from, Street $destination, $distanceInKm) {
        $this->setFrom($from);
        $this->setdestination($destination);
        $this->setDistanceInKm($distanceInKm);
    }


    public function setFrom(Street $from) { $this->from = $from; }
    public function getFrom() { return $this->from; }

    public function setdestination(Street $destination) { $this->destination = $destination; }
    public function getdestination() { return $this->destination; }

    public function setDistanceInKm($distanceInKm) { $this->distanceInKm = $distanceInKm; }
    public function getDistanceInKm() { return $this->distanceInKm; }
}
