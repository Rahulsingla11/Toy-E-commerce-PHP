<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'otp';

$con = new mysqli($host, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>