<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Allow: GET, POST, PUT, DELETE');
header('content-Type: application/json; charset=utf-8');

require_once '../models/personas.php';
$personas = new personas();

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $result = $personas->getPersonas($id);
      if ($result) {
        echo json_encode($result);
      } else {
        echo json_encode(array("message" => "Persona not found."));
      }
    } else {
      $result = $personas->getPersonas();
      echo json_encode($result);
    }
    break;
  case 'POST':
    if (isset($_POST['ci']) && isset($_POST['pri_nom']) && isset($_POST['pri_ape'])) {
      $ci = $_POST['ci'];
      $pri_nom = $_POST['pri_nom'];
      $seg_nom = isset($_POST['seg_nom']) ? $_POST['seg_nom'] : null;
      $pri_ape = $_POST['pri_ape'];
      $seg_ape = isset($_POST['seg_ape']) ? $_POST['seg_ape'] : null;
      $result = $personas->insertPersona($ci, $pri_nom, $seg_nom, $pri_ape, $seg_ape);
      if ($result) {
        echo json_encode(array("message" => "Persona created successfully.", "id" => $result));
      } else {
        echo json_encode(array("message" => "Failed to create persona."));
      }
    } else {
      echo json_encode(array("message" => "Required fields not provided."));
    }
    break;
  case 'PUT':
    parse_str(file_get_contents("php://input"), $_PUT);
    if (isset($_PUT['ci']) && isset($_PUT['pri_nom']) && isset($_PUT['pri_ape'])) {
      $ci = $_PUT['ci'];
      $pri_nom = $_PUT['pri_nom'];
      $seg_nom = isset($_PUT['seg_nom']) ? $_PUT['seg_nom'] : null;
      $pri_ape = $_PUT['pri_ape'];
      $seg_ape = isset($_PUT['seg_ape']) ? $_PUT['seg_ape'] : null;
      $result = $personas->updatePersona($ci, $pri_nom, $seg_nom, $pri_ape, $seg_ape);
      if ($result) {
        echo json_encode(array("message" => "Persona updated successfully."));
      } else {
        echo json_encode(array("message" => "Failed to update persona."));
      }
    } else {
      echo json_encode(array("message" => "Required fields not provided."));
    }
    break;
  case 'DELETE':
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $result = $personas->deletePersona($id);
      if ($result) {
        echo json_encode(array("message" => "Persona deleted successfully."));
      } else {
        echo json_encode(array("message" => "Failed to delete persona."));
      }
    } else {
      echo json_encode(array("message" => "ID not provided."));
    }
    break;
  default:
    echo json_encode(array("message" => "Method not allowed."));
    break;
}
