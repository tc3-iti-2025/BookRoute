<?php

require_once '../models/usuarios.php';
$usuarios = new usuarios();

switch ($_SERVER['REQUEST_METHOD']){
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
      $password = $_POST['password'];
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
    parse_str(file_get_contents("php://input"), $_PUT);
    if (isset($_PUT['persona']) && isset($_PUT['correo']) && isset($_PUT['password']) && isset($_PUT['rol'])) {
      $persona = $_PUT['persona'];
      $correo = $_PUT['correo'];
      $password = $_PUT['password'];
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
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $result = $usuarios->deleteUsuario($id);
      if ($result) {
        echo json_encode(array("message" => "Usuario deleted successfully.")); 
      }
      else {
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

