<?php
$host = 'localhost';
$db = 'phone_finder';
$user = 'root';
$pass = '';

$connection = new mysqli($host, $user, $pass, $db);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// session_start();
?>
