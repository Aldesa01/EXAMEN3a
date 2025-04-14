<?php
require_once 'Connection.php';
require_once 'Lamp.php';

class Lighting extends Connection
{
    public function getAllLamps()
    {
        $sql = "SELECT lamps.lamp_id, lamps.lamp_name, lamp_on,
        lamp_models.model_part_number, lamp_models.model_wattage,
        zones.zone_name FROM lamps INNER JOIN lamp_models ON 
        lamps.lamp_model=lamp_models.model_id INNER JOIN zones ON
        lamps.lamp_zone = zones.zone_id ORDER BY lamps.lamp_id";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $lamps = [];

        foreach ($rows as $row) {
            $lamp = new Lamp();
            $lamp->setId($row['lamp_id']);
            $lamp->setName($row['lamp_name']);
            $lamp->setOn($row['lamp_on']);
            $lamp->setModelPartNumber($row['model_part_number']);
            $lamp->setModelWattage($row['model_wattage']);
            $lamp->setZoneName($row['zone_name']);
            $lamps[] = $lamp;
        }

        return $lamps;
    }

    public function drawLampsList()
    {
        $lamps = $this->getAllLamps();
        echo '<table class="greenTable">';
        echo '<thead><tr><th>ID</th><th>Name</th><th>On</th><th>Model Part Number</th><th>Model Wattage</th><th>Zone Name</th></tr></thead>';
        foreach ($lamps as $lamp) {
            echo '<tr>';
            echo '<td>' . $lamp->getId() . '</td>';
            echo '<td>' . $lamp->getName() . '</td>';
            echo '<td>' . $lamp->isOn() . '</td>';
            echo '<td>' . $lamp->getModelPartNumber() . '</td>';
            echo '<td>' . $lamp->getModelWattage() . '</td>';
            echo '<td>' . $lamp->getZoneName() . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    public function getPowerByZone()
    {
        $sql = "SELECT zones.zone_name, SUM(lamp_models.model_wattage) as power FROM lamps 
        INNER JOIN lamp_models ON lamps.lamp_model = lamp_models.model_id 
        INNER JOIN zones ON lamps.lamp_zone = zones.zone_id 
        WHERE lamps.lamp_on = 1 
        GROUP BY zones.zone_name";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $powerByZone = [];

        foreach ($rows as $row) {
            $powerByZone[$row['zone_name']] = $row['power'];
        }

        return $powerByZone;
    }
}
?>