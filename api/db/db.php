<?php

$HOSTNAME = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE = "BookRoute";

$connection = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}