<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
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

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        a {
            background-color: #ff8c00;
            color: #fff;
            padding: 10px 20px;
            border: none;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #ff6f00;
        }
    </style>
</head>

<body>
<?php
$userid=$_GET['user_id']
?>
    <a href="toy.php?user_id=<?php echo $userid; ?>">Continue Shopping</a>
    <h1>
        <?php
        if (isset($_SESSION['order_success_message'])) {
            echo $_SESSION['order_success_message'];
            unset($_SESSION['order_success_message']); 
            // unset($_SESSION["shopping_cart"]);
        } else {
            echo "Order not found.";
        }
        ?>
    </h1>
</body>

</html>
