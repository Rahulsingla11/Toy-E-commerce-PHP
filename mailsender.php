<?php
include "db1.php";
$to =$_GET['email'];
$txt =rand(10000, 99999);
$subject ="Email verification code : $txt";
$headers ="Email verification by Shield";
mail($to,$subject,$txt,$headers);
$sql = "INSERT INTO str (otp) VALUES('$txt')";
$result = $con->query($sql);
$userid=$_GET['user_id'];
header("location:verfication.php?user_id=$userid");
?>  