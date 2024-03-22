<?php
include('db.php');

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags($input));
}

$order_number = sanitizeInput($_GET['tracking_id']);
$sql = "SELECT * FROM order_items WHERE order_numbers = '$order_number'";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            color: #333;
        }

        .img-container img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-cancel {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin:2px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background-color: #bd2130;
        }
    </style>
</head>

<body>
    <?php
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    ?>
        <?php $userid = sanitizeInput($_GET['user_id']) ?>
        <a href="myorder.php?user_id=<?php echo $userid; ?>" class="btn btn-primary">Back</a>
        <h2>Order Details</h2>
        <table>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Order Number</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>
                    <div class="img-container">
                        <img src="<?php echo $order['img']; ?>" alt="Product Image">
                    </div>
                </td>
                <td><?php echo $order['product_name'] ?></td>
                <td><?php echo $order['order_numbers']; ?></td>
              <td>
                    <a href='cancal.php?deleteid=<?php echo $order['order_numbers']; ?>&user_id=<?php echo $userid; ?>'>
                        <button type='button' class='btn btn-cancel'>Cancel Order</button>
                    </a>
                    <a href='track.php?tracking_id=<?php echo $order['order_numbers']; ?>&user_id=<?php echo $userid; ?>'>
                        <button type='button' class='btn btn-cancel'>Tracking Order</button>
                    </a>
                </td>
            </tr>
        </table>
    <?php } else {
        echo "<p>Order not found.</p>";
    }
    $con->close();
    ?>
</body>

</html>
