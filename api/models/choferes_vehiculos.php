<?php

require_once '../db/db.php';
class choferes_vehiculos
{
  public $chofer;
  public $vehiculo;

  public function __construct($chofer=null, $vehiculo=null)
  {
    $this->chofer = $chofer;
    $this->vehiculo = $vehiculo;
  }

  public function insertChoferVehiculo($chofer, $vehiculo)
  {
    global $db;
    $query = "INSERT INTO choferes_vehiculos (chofer, vehiculo) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $chofer, $vehiculo);
    if ($stmt->execute()) {
      return $db->insert_id;
    } else {
      return false;
    }
  }
  public function updateChoferVehiculo($chofer, $vehiculo)
  {
    global $db;
    $query = "UPDATE choferes_vehiculos SET vehiculo=? WHERE chofer=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $vehiculo, $chofer);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function deleteChoferVehiculo($chofer, $vehiculo)
  {
    global $db;
    $query = "UPDATE FROM choferes_vehiculos SET is_active=false WHERE chofer=? AND vehiculo=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $chofer, $vehiculo);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getChoferesVehiculos($chofer = null, $vehiculo = null)
  {
    global $db;
    $choferes_vehiculos = array();
    if (!$chofer && !$vehiculo) {
      $query = "SELECT * FROM choferes_vehiculos WHERE is_active=true";
      $stmt = $db->prepare($query);
    }
    if ($chofer && !$vehiculo) {
      $query = "SELECT * FROM choferes_vehiculos WHERE chofer=? AND is_active=true";
      $stmt = $db->prepare($query);
      $stmt->bind_param("i", $chofer);
    }
    if (!$chofer && $vehiculo) {
      $query = "SELECT * FROM choferes_vehiculos WHERE vehiculo=? AND is_active=true";
      $stmt = $db->prepare($query);
      $stmt->bind_param("i", $vehiculo);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $choferes_vehiculos[] = $row;
    }
    return $choferes_vehiculos;
  }
}
