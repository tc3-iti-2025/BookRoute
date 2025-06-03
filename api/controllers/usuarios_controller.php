<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Allow: GET, POST, PUT, DELETE');
header('content-Type: application/json; charset=utf-8');

require_once '../models/usuarios.php';
$usuarios = new usuarios();

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $response = $usuarios->getUsuarios();
    if (isset($_GET['id'])) {
      $response = $usuarios->getUsuarios($_GET['id']);
    }
    echo json_encode($response);
    break;
  case 'POST':
    if (isset($_POST['persona']) && isset($_POST['correo']) && isset($_POST['password']) && isset($_POST['rol'])) {
      $persona = $_POST['persona'];
      $correo = $_POST['correo'];
      $password = md5($_POST['password']);
      $rol = $_POST['rol'];
      $result = $usuarios->insertUsuario($persona, $correo, $password, $rol);
      if ($result) {
        echo json_encode(array("message" => "Usuario created successfully.", "id" => $result));
      } else {
        echo json_encode(array("message" => "Failed to create usuario."));
      }
    } else {
      echo json_encode(array("message" => "Required fields not provided."));
    }
    break;
  case 'PUT':
    $_PUT = json_decode(file_get_contents("php://input"), true);
    if (isset($_PUT['persona']) && isset($_PUT['correo']) && isset($_PUT['password']) && isset($_PUT['rol']) && isset($_PUT['id'])) {
      $persona = $_PUT['persona'];
      $correo = $_PUT['correo'];
      $password = md5($_PUT['password']);
      $rol = $_PUT['rol'];
      $id = $_PUT['id'];

      $result = $usuarios->updateUsuario($persona, $correo, $password, $rol, $id);
      if ($result) {
        echo json_encode(array("message" => "Usuario updated successfully."));
      } else {
        echo json_encode(array("message" => "Failed to update usuario."));
      }
    } else {
      echo json_encode(array("message" => "Required fields not provided."));
    }
    break;
  case 'DELETE':
    $_DELETE = json_decode(file_get_contents('php://input'), true);
    if (isset($_DELETE['id'])) {
      $id = $_DELETE['id'];
      $result = $usuarios->deleteUsuario($id);
      if ($result) {
        echo json_encode(array("message" => "Usuario deleted successfully."));
      } else {
        echo json_encode(array("message" => "Failed to delete usuario."));
      }
    } else {
      echo json_encode(array("message" => "ID not provided."));
    }
    break;
  default:
    echo json_encode(array("message" => "Invalid request method."));
    break;
}
