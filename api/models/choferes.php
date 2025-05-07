<?php

/*
create table choferes(
  id int auto_increment not null,
  persona int,
  vencimiento_libreta date not null,
  categoria_libreta varchar(3) not null,
  habilitado boolean default true,
  primary key(id),
  foreign key (persona) references personas(id)
);
*/

require_once '../db/db.php';
class choferes
{
  public $id;
  public $persona;
  public $vencimiento_libreta;
  public $categoria_libreta;
  public $habilitado;

  public function __construct($id = null, $persona = null, $vencimiento_libreta = null, $categoria_libreta = null, $habilitado = null)
  {
    $this->id = $id;
    $this->persona = $persona;
    $this->vencimiento_libreta = $vencimiento_libreta;
    $this->categoria_libreta = $categoria_libreta;
    $this->habilitado = $habilitado;
  }

  public function insertChofer($persona, $vencimiento_libreta, $categoria_libreta, $habilitado) {
    global $db;
    $query = "INSERT INTO choferes (persona, vencimiento_libreta, categoria_libreta, habilitado) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("issi", $persona, $vencimiento_libreta, $categoria_libreta, $habilitado);
    if ($stmt->execute()) {
      return $db->insert_id;
    } else {
      return false;
    }
  }
  public function updateChofer($persona, $vencimiento_libreta, $categoria_libreta, $habilitado) {
    global $db;
    $query = "UPDATE choferes SET vencimiento_libreta=?, categoria_libreta=?, habilitado=? WHERE persona=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("issi", $vencimiento_libreta, $categoria_libreta, $habilitado, $persona);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function deleteChofer($id) {
    global $db;
    $query = "UPDATE choferes SET habilitado=false WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getChoferes($id = null) {
    global $db;
    if ($id) {
      $query = "SELECT * FROM choferes WHERE id=? AND habilitado=true";
      $stmt = $db->prepare($query);
      $stmt->bind_param("i", $id);
    } else {
      $query = "SELECT * FROM choferes WHERE habilitado=true";
      $stmt = $db->prepare($query);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  public function validateChofer($persona, $vencimiento_libreta, $categoria_libreta, $habilitado) {
    global $db;
    $query = "SELECT * FROM choferes WHERE persona=? AND vencimiento_libreta=? AND categoria_libreta=? AND habilitado=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("issi", $persona, $vencimiento_libreta, $categoria_libreta, $habilitado);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
