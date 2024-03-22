<?php
include('db.php'); // Include the database connection file
session_start();

function OrderNumber() {
    return date("YmdHis") . rand(1000, 9999);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_SESSION["shopping_cart"] as $product) {
            $userid11 = $_GET['user_id'];
            $order_number = OrderNumber();
            $customer_name = $_POST['customer_name'];
            $order_status = "Processing";
            $product_code = $product["code"];
            $quantity = $product["quantity"];
            $price = $product["price"];
            $name = $product["name"];
            $image = $product["image"];

            $itemSql = "INSERT INTO order_items (product_name, product_code, quantity, price, img, user,order_numbers, order_status, Customer_name) 
                        VALUES ( '$name', '$product_code', '$quantity', '$price', '$image','$userid11','$order_number','$order_status','$customer_name')";
            $con->query($itemSql);
        }
        unset($_SESSION["shopping_cart"]);
        $_SESSION['order_success_message'] = "Order placed successfully. Your Tracking number is: $order_number";
        header("Location: succorder.php?user_id=$userid11");
        exit();
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placement</title>
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

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #ff8c00; 
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff6f00; 
        }

        .a {
            background-color: #ff8c00; 
            color: #fff;
            padding: 10px 20px;
            border: none;
            text-decoration: none; 
            border-radius: 5px;
            cursor: pointer;
        }

        .a:hover {
            background-color: #ff6f00;
        }
    </style>
</head>

<body>
<?php
$userid1=$_GET['user_id']
?>
    <a class="a" href="toy.php?user_id=<?php echo $userid1; ?>">Home</a>
    <h2>Place an Order</h2>
    <form action="" method="post">
        <label for="customer_name">Your Name:</label>
        <input type="text" name="customer_name" required>
        <button type="submit">Place Order</button>
    </form>
</body>

</html>