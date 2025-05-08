<?php

require_once '../db/db.php';
require_once '../models/usuarios.php';

$usuarios = new usuarios();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $correo = $_POST['correo'];
  $password = $_POST['password'];
  $btnLogin = $_POST['btnLogin'];

  if ($correo && $password) {
    $result = $usuarios->iniciarSesion($correo, $password);
    if ($result) {
      if ($result['message' == "Admin"]) {
        header("Location: /bookroute/admin.html");
      }
      if ($result['message' == "User"]) {
        header("Location: /bookroute/index.html");
      }
    }
    header("Location: /bookroute/login.html");
  }
}
