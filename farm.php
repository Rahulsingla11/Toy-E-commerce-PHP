<?php
include "db1.php";

$sql = "SELECT * FROM str ORDER BY id DESC LIMIT 1";

$result = mysqli_query($con, $sql);
$userid=$_GET['user_id'];
if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $otp = $_POST['otp'];
        $latestId = $row['otp']; 
        if ($otp == $latestId) {
            header("location: toy.php?user_id=$userid");
        } else {
            echo "wrong otp";
        }
    }
}

mysqli_close($con);
?>
