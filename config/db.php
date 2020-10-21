<?php

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $servername = 'localhost';
    $username   = 'root';
    $password   = '';
    $database   = 'khao_gully';
} else {
    $servername = 'localhost';
    $username   = ''; // user
    $password   = ''; // password
    $database   = ''; // database
}

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

?>