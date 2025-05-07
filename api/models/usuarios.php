<?php

require_once '../db/db.php';
class usuarios
{
  public $id;
  public $persona;
  public $correo;
  public $password;
  public $rol;

  public function __construct($id=null, $persona=null, $correo=null, $password=null, $rol=null)
  {
    $this->id = $id;
    $this->persona = $persona;
    $this->correo = $correo;
    $this->password = $password;
    $this->rol = $rol;
  }

  public function insertUsuario($persona, $correo, $password, $rol){
    global $db;
    $query = "INSERT INTO usuarios (persona, correo, password, rol) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("issi", $persona, $correo, $password, $rol);
    if ($stmt->execute()) {
      return $db->insert_id;
    } else {
      return false;
    }
  }
  public function updateUsuario($persona, $correo, $password, $rol, $id){
    global $db;
    $query = "UPDATE usuarios SET persona=?, correo=?, password=?, rol=? WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("issii", $persona, $correo, $password, $rol, $id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function deleteUsuario($id){
    global $db;
    $query = "UPDATE usuarios SET is_active=false WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getUsuarios($id=null){
    global $db;
    if ($id) {
      $query = "SELECT * FROM usuarios WHERE id=? AND is_active=true";
      $stmt = $db->prepare($query);
      $stmt->bind_param("i", $id);
    } else {
      $query = "SELECT * FROM usuarios WHERE is_active=true";
      $stmt = $db->prepare($query);
    }
    if ($stmt->execute()) {
      return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } else {
      return false;
    }
  }
  public function validateUsuario($persona, $correo, $password, $rol){
    global $db;
    $query = "SELECT * FROM usuarios WHERE persona=? AND correo=? AND password=? AND rol=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("issi", $persona, $correo, $password, $rol);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
