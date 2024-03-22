<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['email1'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <h1>Welcome, <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : $_SESSION['email1']; ?>!</h1>
    <form method="post">
        <button type="submit" class="btn btn-primary" name="logout">Logout</button>
    </form>
</body>

</html>
