<?php

class Lamp {
    private $lampId;
    private $name;
    private $isOn;
    private $model;
    private $power;
    private $zone;

    public function __construct($lampId, $name, $isOn, $model, $power, $zone) {
        $this->lampId = $lampId;
        $this->name = $name;
        $this->isOn = $isOn;
        $this->model = $model;
        $this->power = $power;
        $this->zone = $zone;
    }

    public function getLampId() {
        return $this->lampId;
    }

    public function getName() {
        return $this->name;
    }

    public function getIsOn() {
        return $this->isOn;
    }

    public function getModel() {
        return $this->model;
    }

    public function getPower() {
        return $this->power;
    }

    public function getZone() {
        return $this->zone;
    }

    public function setLampId($lampId) {
        $this->lampId = $lampId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setIsOn($isOn) {
        $this->isOn = $isOn;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function setPower($power) {
        $this->power = $power;
    }

    public function setZone($zone) {
        $this->zone = $zone;
    }
}

?>