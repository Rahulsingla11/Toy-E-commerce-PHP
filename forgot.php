<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>DATA</title>
</head>
<body>
<?php
include "logincon.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $result = $conn->query("SELECT * FROM str WHERE email = '$email'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $password = $row['pass'];
    } else {
        echo "User not found.";
    }

    $newPassword = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE str SET pass=? WHERE email=?");
    $stmt->bind_param("ss", $newPassword, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("location: login.php");
        exit();
    } else {
        echo "Error updating password: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
<form class="container" method="post">
    <div class="mb-3 my-4">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" Placeholder="Enter your email"  value="<?php echo $email; ?>" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter your new password" value="<?php echo $password; ?>">
    </div>
    <input type="submit" class="btn btn-primary" value="Submit">
</form>
</body>
</html>
