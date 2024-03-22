<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>HOME</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        table a,
        table a:link,
        table a:visited {
            color: #007bff !important;
            text-decoration: none;
        }

        table a:hover,
        table a:active {
            color: #0056b3 !important;
        }

        button {
            background-color: orange;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #333;
        }

        .details {
            display: none;
        }

        .img-container {
            width: 50px; /* Adjust as needed */
            height: 50px; /* Adjust as needed */
            overflow: hidden;
            border-radius: 50%;
        }

        .img-container img {
            width: 100%;
            height: auto;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <?php
    $userid = $_GET['user_id'];
    ?>
    <div class="container">
        <a href="cart.php?user_id=<?php echo $userid; ?>">
            <button type="button" class="btn btn-primary my-4">Home</button>
        </a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Name</th>
                    <th scope="col">Tracking ID</th>
                    <th scope="col">Order Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
include "db.php";

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$userid = $_GET['user_id'];
$result = $con->query("SELECT * FROM order_items WHERE user=$userid");
while ($row = $result->fetch_assoc()) {
    echo 
    '<tr class="toggle-row">
        <td>
            <div class="img-container">
                <a href="#"><img src="' . $row['img'] . '" alt="Product Image"></a>
            </div>
        </td>
        <td><a href="trackdetails.php?tracking_id=' . $row['order_numbers'] . '&amp;user_id=' . $userid . '">' . $row['product_name'] . '</a></td>
        <td><a href="trackdetails.php?tracking_id=' . $row['order_numbers'] . '&amp;user_id=' . $userid . '">' . $row['Customer_name'] . '</a></td>
        <td><a href="trackdetails.php?tracking_id=' . $row['order_numbers'] . '&amp;user_id=' . $userid . '">' . $row['order_numbers'] . '</a></td>
        <td><a href="trackdetails.php?tracking_id=' . $row['order_numbers'] . '&amp;user_id=' . $userid . '">' . $row['order_date'] . '</a></td>
       </tr>';
}

$con->close();
?>
            </tbody>
        </table>
    </div>
</body>

</html>
