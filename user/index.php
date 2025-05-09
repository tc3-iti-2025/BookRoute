<?php

session_start();
echo "Hola $_SESSION[nombre]";

?>
<DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/logoBookRouteDark.svg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
  </head>

  <body>
    <form action="/bookroute/api/controllers/auth_login.php" method="post">
      <input type="submit" value="Cerrar Sesión" name="btnLogout" id="btnLogout">
    </form>
  </body>

  </html>