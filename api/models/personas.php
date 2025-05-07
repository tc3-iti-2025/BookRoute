<?php

require_once '../db/db.php';

class personas
{
  public $id;
  public $ci;
  public $pri_nom;
  public $seg_nom;
  public $pri_ape;
  public $seg_ape;

  public function __construct($id = null, $ci = null, $pri_nom = null, $seg_nom = null, $pri_ape = null, $seg_ape = null)
  {
    $this->id = $id;
    $this->ci = $ci;
    $this->pri_nom = $pri_nom;
    $this->seg_nom = $seg_nom;
    $this->pri_ape = $pri_ape;
    $this->seg_ape = $seg_ape;
  }

  public function insertPersona($ci, $pri_nom, $seg_nom, $pri_ape, $seg_ape)
  {
    global $db;
    $query = "INSERT INTO personas (ci, pri_nom, seg_nom, pri_ape, seg_ape) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("issss", $ci, $pri_nom, $seg_nom, $pri_ape, $seg_ape);
    if ($stmt->execute()) {
      return $db->insert_id;
    } else {
      return false;
    }
  }
  public function updatePersona($ci, $pri_nom, $seg_nom, $pri_ape, $seg_ape)
  {
    global $db;
    $query = "UPDATE personas SET pri_nom=?, seg_nom=?, pri_ape=?, seg_ape=? WHERE ci=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssssi", $pri_nom, $seg_nom, $pri_ape, $seg_ape, $ci);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function deletePersona($id)
  {
    global $db;
    $query = "UPDATE personas SET is_active=false WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getPersonas($id = null)
  {
    global $db;
    $query = "SELECT * FROM personas WHERE is_active=true";
    $personas = array();
    if ($id) {
      $query .= " AND id=?";
      $stmt = $db->prepare($query);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
    } else {
      $stmt = $db->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();
    }
    while ($row = $result->fetch_assoc()) {
      $personas[] = new personas($row['id'], $row['ci'], $row['pri_nom'], $row['seg_nom'], $row['pri_ape'], $row['seg_ape']);
    }
    return $personas;
  }
}
