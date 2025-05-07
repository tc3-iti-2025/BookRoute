<?php

$HOSTNAME = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE = "BookRoute";

$db = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}