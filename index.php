<?php

session_start();

if (!isset($_SESSION['rol'])) {
  header('Location: auth/login.html');
  exit();
}
if ($_SESSION['rol'] == 1) {
  header('Location: admin/index.html');
  exit();
}
if ($_SESSION['rol'] == 2) {
  header('Location: user/index.html');
  exit();
}
