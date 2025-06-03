<?php

require_once '../db/db.php';
class viajes
{
  public $id;
  public $chofer;
  public $vehiculo;
  public $ruta;
  public $precio;

  public function __construct($id = null, $chofer = null, $vehiculo = null, $ruta = null, $precio = null)
  {
    $this->id = $id;
    $this->chofer = $chofer;
    $this->vehiculo = $vehiculo;
    $this->ruta = $ruta;
    $this->precio = $precio;
  }

  public function insertViaje($chofer, $vehiculo, $ruta, $precio)
  {
    global $db;
    $query = "INSERT INTO viajes (chofer, vehiculo, ruta, precio) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("iiid", $chofer, $vehiculo, $ruta, $precio);
    if ($stmt->execute()) {
      return $db->insert_id;
    } else {
      return false;
    }
  }
  public function updateViaje($id, $chofer, $vehiculo, $ruta, $precio)
  {
    global $db;
    $query = "UPDATE viajes SET chofer=?, vehiculo=?, ruta=?, precio=? WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("iiidi", $chofer, $vehiculo, $ruta, $precio, $id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function deleteViaje($id)
  {
    global $db;
    $query = "UPDATE viajes SET is_active=0 WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getViajes($id = null)
  {
    global $db;
    $query = "SELECT * FROM viajes WHERE is_active=1";
    $stmt = $db->prepare("SELECT * FROM viajes");
    if ($id) {
      $query = "SELECT * FROM viajes WHERE id=? AND is_active=1";
      $stmt = $db->prepare($query);
      $stmt->bind_param("i", $id);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return ($result) ? $result->fetch_all(MYSQLI_ASSOC) : [];
  }
  public function mostrarViajes()
  {
    global $db;
    $query = "SELECT viajes.id, personas.pri_nom, personas.pri_ape, 
              vehiculos.matricula, vehiculos.tipo, vehiculos.asientos_totales, 
              rutas.origen, rutas.destino, rutas.distancia ,viajes.precio
              FROM viajes
              LEFT JOIN choferes ON viajes.chofer = choferes.id
              LEFT JOIN vehiculos ON viajes.vehiculo = vehiculos.id
              LEFT JOIN rutas ON viajes.ruta = rutas.id
              INNER JOIN personas ON choferes.persona = personas.id";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return ($result) ? $result->fetch_all(MYSQLI_ASSOC) : [];
  }
}
