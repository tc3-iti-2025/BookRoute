<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Allow: GET, POST, PUT, DELETE');
header('content-Type: application/json; charset=utf-8');

require_once '../models/viajes.php';
$viajes = new viajes();

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    if (isset($_GET['action']) && $_GET['action'] == 'getDestinations') {
      $result = $viajes->mostrarViajes();
      echo json_encode($result);
      exit;
    }
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $result = $viajes->getViajes($id);
      if ($result) {
        echo json_encode($result);
      } else {
        echo json_encode(array("message" => "Viaje not found."));
      }
    } else {
      $result = $viajes->getViajes();
      echo json_encode($result);
    }
    break;
  case 'POST':
    if (isset($_POST['vehiculo']) && isset($_POST['chofer']) && isset($_POST['ruta']) && isset($_POST['precio'])) {
      $ruta = $_POST['ruta'];
      $precio = $_POST['precio'];
      $vehiculo = $_POST['vehiculo'];
      $chofer = $_POST['chofer'];
      $result = $viajes->insertViaje($chofer, $vehiculo, $ruta, $precio);
      if ($result) {
        echo json_encode(array("message" => "Viaje created successfully.", "id" => $result));
      } else {
        echo json_encode(array("message" => "Failed to create viaje."));
      }
    } else {
      echo json_encode(array("message" => "Required fields not provided."));
    }
    break;
  case 'PUT':
    parse_str(file_get_contents("php://input"), $_PUT);
    if (isset($_PUT['id']) && isset($_PUT['vehiculo']) && isset($_PUT['chofer']) && isset($_PUT['ruta']) && isset($_PUT['precio'])) {
      $id = $_PUT['id'];
      $ruta = $_PUT['ruta'];
      $precio = $_PUT['precio'];
      $vehiculo = $_PUT['vehiculo'];
      $chofer = $_PUT['chofer'];
      $result = $viajes->updateViaje($id, $chofer, $vehiculo, $ruta, $precio);
      if ($result) {
        echo json_encode(array("message" => "Viaje updated successfully."));
      } else {
        echo json_encode(array("message" => "Failed to update viaje."));
      }
    } else {
      echo json_encode(array("message" => "Required fields not provided."));
    }
    break;
  case 'DELETE':
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $result = $viajes->deleteViaje($id);
      if ($result) {
        echo json_encode(array("message" => "Viaje deleted successfully."));
      } else {
        echo json_encode(array("message" => "Failed to delete viaje."));
      }
    } else {
      echo json_encode(array("message" => "ID not provided."));
    }
    break;
  default:
    echo json_encode(array("message" => "Invalid request method."));
    break;
}
