<?php

require_once '../models/choferes.php';
$choferes = new choferes();

switch ($_SERVER['REQUEST_METHOD']) { // GET, POST, PUT, DELETE
  case 'GET':
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $result = $choferes->getChoferes($id);
      if ($result) {
        echo json_encode($result);
      } else {
        echo json_encode(array("message" => "Chofer not found."));
      }
    } else {
      $result = $choferes->getChoferes();
      echo json_encode($result);
    }
    break;
  case 'POST':
    if (isset($_POST['persona']) && isset($_POST['vencimiento_libreta']) && isset($_POST['categoria_libreta']) && isset($_POST['habilitado'])) {
      $persona = $_POST['persona'];
      $vencimiento_libreta = $_POST['vencimiento_libreta'];
      $categoria_libreta = $_POST['categoria_libreta'];
      $habilitado = $_POST['habilitado'];
      $result = $choferes->insertChofer($persona, $vencimiento_libreta, $categoria_libreta, $habilitado);
      if ($result) {
        echo json_encode(array("message" => "Chofer created successfully.", "id" => $result));
      } else {
        echo json_encode(array("message" => "Failed to create chofer."));
      }
    } else {
      echo json_encode(array("message" => "Required fields not provided."));
    }
    break;
  case 'PUT':
    parse_str(file_get_contents("php://input"), $_PUT);
    if (isset($_PUT['id']) && isset($_PUT['vencimiento_libreta']) && isset($_PUT['categoria_libreta']) && isset($_PUT['habilitado'])) {
      $id = $_PUT['id'];
      $vencimiento_libreta = $_PUT['vencimiento_libreta'];
      $categoria_libreta = $_PUT['categoria_libreta'];
      $habilitado = $_PUT['habilitado'];
      $result = $choferes->updateChofer($id, $vencimiento_libreta, $categoria_libreta, $habilitado);
      if ($result) {
        echo json_encode(array("message" => "Chofer updated successfully."));
      } else {
        echo json_encode(array("message" => "Failed to update chofer."));
      }
    } else {
      echo json_encode(array("message" => "Required fields not provided."));
    }
    break;
  case 'DELETE':
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $result = $choferes->deleteChofer($id);
      if ($result) {
        echo json_encode(array("message" => "Chofer deleted successfully."));
      } else {
        echo json_encode(array("message" => "Failed to delete chofer."));
      }
    } else {
      echo json_encode(array("message" => "ID not provided."));
    }
    break;
  default:
    echo json_encode(array("message" => "Invalid request method."));
    break;
}
