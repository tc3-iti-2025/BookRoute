<?php

require_once '../models/usuarios.php';
$usuarios = new usuarios();

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $result = $usuarios->getUsuarios($id);
      if ($result) {
        echo json_encode($result);
      } else {
        echo json_encode(array("message" => "Usuario not found."));
      }
    } else {
      $result = $usuarios->getUsuarios();
      echo json_encode($result);
    }
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
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input['persona']) && isset($input['correo']) && isset($input['password']) && isset($input['rol']) && isset($input['id'])) {
      $persona = $input['persona'];
      $correo = $input['correo'];
      $password = md5($input['password']);
      $rol = $input['rol'];
      $id = $input['id'];

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
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
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
