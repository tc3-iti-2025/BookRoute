<?php
session_start();
echo "Hola $_SESSION[nombre]";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <p>sos admin </p>
  <form action="/bookroute/api/controllers/auth_login.php" method="post">
    <input type="submit" value="Cerrar Sesión" name="btnLogout" id="btnLogout">
  </form>
</body>

</html>