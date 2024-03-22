<?php
include "db.php";

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$deleteid = $_GET['deleteid'];

$sql = "DELETE FROM order_items WHERE order_numbers = '$deleteid'";
$result = $con->query($sql);

if ($result) {
    $userid = $_GET['user_id'];
    header("location: myorder.php?user_id=$userid");
} else {
    echo "Error deleting record: " . $con->error;
}

$con->close();
?>
