<?php

require_once '../db/db.php';
require_once 'personas.php';
class usuarios extends personas
{
  public $id;
  public $persona;
  public $correo;
  public $password;
  public $rol;

  public function __construct($id = null, $persona = null, $correo = null, $password = null, $rol = null)
  {
    parent::__construct($ci = null, $pri_nom = null, $seg_nom = null, $pri_ape = null, $seg_ape = null);
    $this->id = $id;
    $this->persona = $persona;
    $this->correo = $correo;
    $this->password = $password;
    $this->rol = $rol;
  }

  public function insertUsuario($ci, $pri_nom, $seg_nom, $pri_ape, $seg_ape, $correo, $password, $rol)
  {
    global $db;
    $persona = parent::insertPersona($ci, $pri_nom, $seg_nom, $pri_ape, $seg_ape);
    if (!$persona) {
      return false;
    }
    $personas = parent::getPersonas();
    if (!$personas) {
      return false;
    }
    foreach ($personas as $row) {
      if ($row['ci'] == $ci) {
        $persona = $row['id'];
        break;
      }
    }
    $query = "INSERT INTO usuarios (persona, correo, password, rol) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("issi", $persona, $correo, $password, $rol);
    if ($stmt->execute()) {
      return $db->insert_id;
    } else {
      return false;
    }
  }
  public function updateUsuario($correo, $password, $rol, $id)
  {
    global $db;
    $query = "UPDATE usuarios SET correo=?, password=?, rol=? WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssii", $correo, $password, $rol, $id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function deleteUsuario($id)
  {
    global $db;
    $query = "UPDATE usuarios SET is_active=0 WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getUsuarios($id = null)
  {
    global $db;
    if ($id) {
      $query = "SELECT * FROM usuarios WHERE id=? AND is_active=1";
      $stmt = $db->prepare($query);
      $stmt->bind_param("i", $id);
    } else {
      $query = "SELECT * FROM usuarios WHERE is_active=1";
      $stmt = $db->prepare($query);
    }
    if ($stmt->execute()) {
      return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } else {
      return false;
    }
  }
  public function iniciarSesion($correo, $password)
  {
    global $db;
    $query = "SELECT * FROM usuarios WHERE correo=? AND password=? AND is_active=1";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $correo, $password);
    if ($stmt->execute()) {
      $result = $stmt->get_result()->fetch_assoc();
      if ($result) {
        if ($result['rol'] == 1) {
          return (array("message" => "Admin", "Datos:" => $result));
        }
        if ($result['rol'] == 2) {
          return (array("message" => "User", "Datos:" => $result));
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}
