<?php

require_once '../db/db.php';

if (isset($_POST['btnLogin'])) {
  $txtCorreo = $_POST['correo'];
  $txtPassword = md5($_POST['password']);

  if (empty($txtCorreo) || empty($txtPassword)) {
    echo "Por favor, complete todos los campos.";
    exit();
  }

  $query = "SELECT * FROM usuarios u, personas p WHERE u.persona = p.id AND correo = ? AND password = ? AND u.is_active = true AND p.is_active = true";
  $stmt = $db->prepare($query);
  $stmt->bind_param("ss", $txtCorreo, $txtPassword);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_assoc();
  if (!$result) {
    echo "Usuario o contraseña incorrectos.";
    exit();
  }
  if ($result) {
    session_start();
    $_SESSION['rol'] = $result['rol'];
    $_SESSION['id'] = $result['id'];
    $_SESSION['nombre'] = $result['pri_nom'];
    echo $_SESSION['rol'];
    echo $result['rol'];
    echo ($_SESSION['rol'] == 1 ? 'admin' : 'user');
    if ($_SESSION['rol'] == 1) {
      header('Location: /bookroute/admin/index.html');
      exit();
    }
    if ($_SESSION['rol'] == 2) {
      header('Location: /bookroute/user/index.html');
      exit();
    }
    header('Location: /bookroute/index.php');
    exit();
  }
}

if (isset($_POST['btnLogout'])) {
  session_start();
  session_destroy();
  header('Location: /bookroute/index.php');
}
