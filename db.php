<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cart';

$con = new mysqli($host, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>