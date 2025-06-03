<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Allow: GET, POST, PUT, DELETE');
header('content-Type: application/json; charset=utf-8');

require_once '../models/choferes_vehiculos.php';
$choferes_vehiculos = new choferes_vehiculos();

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    if (!isset($_GET['chofer']) && !isset($_GET['vehiculo'])) {
      $result = $choferes_vehiculos->getChoferesVehiculos();
    }
    if (isset($_GET['chofer']) && !isset($_GET['vehiculo'])) {
      $chofer = $_GET['chofer'];
      $result = $choferes_vehiculos->getChoferesVehiculos($chofer, null);
    }
    if (isset($_GET['vehiculo']) && !isset($_GET['chofer'])) {
      $vehiculo = $_GET['vehiculo'];
      $result = $choferes_vehiculos->getChoferesVehiculos(null, $vehiculo);
    }
    if (isset($_GET['chofer']) && isset($_GET['vehiculo'])) {
      $chofer = $_GET['chofer'];
      $vehiculo = $_GET['vehiculo'];
      $result = $choferes_vehiculos->getChoferesVehiculos($chofer, $vehiculo);
    }
    echo json_encode($result);
    break;
  case 'POST':
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->chofer) && isset($data->vehiculo)) {
      $chofer = $data->chofer;
      $vehiculo = $data->vehiculo;
      $result = $choferes_vehiculos->insertChoferVehiculo($chofer, $vehiculo);
      echo json_encode($result);
    } else {
      echo json_encode(array("error" => "Invalid input"));
    }
    break;
  case 'PUT':
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->chofer) && isset($data->vehiculo)) {
      $chofer = $data->chofer;
      $vehiculo = $data->vehiculo;
      $result = $choferes_vehiculos->updateChoferVehiculo($chofer, $vehiculo);
      echo json_encode($result);
    } else {
      echo json_encode(array("error" => "Invalid input"));
    }
    break;
  case 'DELETE':
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->chofer) && isset($data->vehiculo)) {
      $chofer = $data->chofer;
      $vehiculo = $data->vehiculo;
      $result = $choferes_vehiculos->deleteChoferVehiculo($chofer, $vehiculo);
      echo json_encode($result);
    } else {
      echo json_encode(array("error" => "Invalid input"));
    }
    break;
  default:
    echo json_encode(array("error" => "Invalid request method"));
    break;
}
