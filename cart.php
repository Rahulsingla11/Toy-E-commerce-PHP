<?php
session_start();
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["code"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
     }  
 }		
}
}
if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as & $value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; 
    }
}	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
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

    .cart {
        background-color: #fff;
        color: #333;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .div{
        display: flex;
    justify-content: center;
    align-items: center; 
    
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    th {
        background-color: #f0f0f0;
        color: #333;
    }

    .remove {
        background-color: #f56c6c;
        color: #fff;
        border: none;
        padding: 8px;
        cursor: pointer;
        border-radius: 3px;
    }

    .quantity {
        padding: 5px;
        border-radius: 3px;
    }

    .message_box {
        margin: 10px 0;
        padding: 10px;
        color: #333;
        font-weight: bold;
        background-color: #e0e0e0;
        border-radius: 5px;
    }

    .btn {
        margin-bottom: 20px;
    }

    .btn a {
        text-decoration: none;
        padding: 10px 20px;
        background-color: orange;
        margin:5px;
        color: #fff;
        border-radius: 5px;
        font-weight: bold;
    }

    .btn a:hover {
        background-color: #45a049;
    }

    img {
        max-width: 100%;
        height: auto;
    }
    .place {
    display: inline-block;
    padding: 10px 20px;
    background-color: #45a049; /* Choose your desired background color */
    color: #fff; /* Text color */
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease; /* Add a smooth transition effect */

}

.place:hover {
    background-color: #357d3a; /* Change background color on hover */
}
    </style>
</head>
<body>
<?php
$userid=$_GET['user_id']
?>
    <div class="div">
        <div class="btn">
            <a href="toy.php?user_id=<?php echo $userid; ?>">Home</a>
        </div>
        <div class="btn">
            <a href="myorder.php?user_id=<?php echo $userid; ?>">My Order</a>
        </div>
    </div>
    <div class="cart">
        <?php
        if(isset($_SESSION["shopping_cart"])){
            $total_price = 0;
        ?>	
        <table class="table">
            <tbody>
                <tr>
                    <td></td>
                    <td>ITEM NAME</td>
                    <td>QUANTITY</td>
                    <td>UNIT PRICE</td>
                    <td>ITEMS TOTAL</td>
                </tr>	
                <?php		
                foreach ($_SESSION["shopping_cart"] as $product){
                ?>
                <tr>
                    <td>
                        <img src='<?php echo $product["image"]; ?>' width="50" height="50" />
                    </td>
                    <td><?php echo $product["name"]; ?><br />
                        <form method='post' action=''>
                            <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                            <input type='hidden' name='action' value="remove"/>
                            <button type='submit' class='remove'>Remove Item</button>
                        </form>
                    </td>
                    <td>
                        <form method='post' action=''>
                            <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                            <input type='hidden' name='action' value="change" />
                            <select name='quantity' class='quantity' onChange="this.form.submit()">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    echo "<option " . ($product["quantity"] == $i ? "selected" : "") . " value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </form>
                    </td>
                    <td><?php echo "$".$product["price"]; ?></td>
                    <td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
                </tr>
                <?php
                    $total_price += ($product["price"]*$product["quantity"]);
                }
                ?>
                <tr>
                   
                    <td colspan="4" align="right">
                        <a class="place" href="place.php?user_id=<?php echo $userid; ?>">
                            Buy Now
                        </a>
                    </td>
                    <td>
                        <strong>TOTAL: <?php echo "$".$total_price; ?></strong>
                    </td>
                </tr>
            </tbody>
        </table>		
        <?php
        } else {
            echo "<h3>Your cart is empty!</h3>";
        }
        ?>
    </div>

    <div style="clear:both;"></div>

</body>
</html>
