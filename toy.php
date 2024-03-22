<?php
session_start();
include('db.php');
if (isset($_POST['code']) && $_POST['code'] != "") {
  $code = $_POST['code'];
  $result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $code = $row['code'];
  $price = $row['price'];
  $image = $row['image'];

  $cartArray = array(
      $code => array(
          'name' => $name,
          'code' => $code,
          'price' => $price,
          'quantity' => 1,
          'image' => $image
      )
  );
  if (empty($_SESSION["shopping_cart"])) {
      $_SESSION["shopping_cart"] = $cartArray;
  } else {
      if (isset($_SESSION["shopping_cart"][$code])) {
          echo 'Product is already added to your cart!';
      } else {
          $_SESSION["shopping_cart"][$code] = $cartArray[$code];
        echo 'Product is added to your cart';
      }
  }
}  
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
      unset($_SESSION["email"]);
  header('Location: login.php');
  exit();
  }
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <title>Shield  Toy  Shop</title>
  <style>
    @media screen and (max-width:600px) {
      #last {
        display: grid;
        grid-template-columns: 5fr;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar sticky-top" style="background-color: #e3f2fd;" id="nav">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="https://i.pinimg.com/originals/e2/2e/d3/e22ed330d027db81cd964bab58d8d2c8.jpg" width="30" height="24"
          style="object-fit: cover;">
      </a>
      <a class="navbar-brand" href="#">Shield</a>
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="#" aria-current="page">Home
              <span class="visually-hidden">(current)</span></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="#Products">Products</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="#team">Our Team</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="#us">About Us</a>
          </li>
          <li>
          <?php
$isUserLoggedIn1 = isset($_SESSION['email']) || isset($_SESSION['email1']);

if ($isUserLoggedIn1) {
    $userid11 =$_SESSION['user'];
    echo '<a href="cart.php?user_id=' . $userid11 . '" class="nav-link active">
            <img src="https://cdn-icons-png.flaticon.com/512/263/263142.png" height="25px" />Cart<span></span>
          </a>';
}
?>

          </li>
        </ul>
        <form method="post" class="d-flex my-2 my-lg-0">
       
        <?php
$isUserLoggedIn = isset($_SESSION['email']) || isset($_SESSION['email1']);

if ($isUserLoggedIn) {
    echo '<button type="submit" class="btn btn-primary" name="logout">Logout</button>';
} elseif (!$isUserLoggedIn) {
    echo '<a href="login.php" class="nav-link active" aria-current="page">
            <img src="https://www.freeiconspng.com/uploads/sign-up-button-png-18.png" height="55px" alt="">
          </a>';
}
?>
  
        </form>

      </div>
    </div>
  </nav>

  <div id="carouselExampleDark" class="carousel carousel-dark slide" style="margin-top: 25px;">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="10000">
        <img src="https://images-cdn.ubuy.co.in/634d15c897202c33c06a7b63-anime-figure-roronoa-zoro-action-figure.jpg" class="d-block w-100"
          style="height:500px; object-fit: cover; object-position: top;" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Zoro</h5>
          <p>One Piece Hero Zoro</p>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <img src="https://i.pinimg.com/736x/95/f1/74/95f174d0763d9eafb16cd911fd4be7a7--cheap-toys-fairy-tail.jpg"
          class="w-100 " style="height:500px ;object-fit: cover; object-position: top;" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Natsu</h5>
          <p>FairyTail Hero</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://m.media-amazon.com/images/W/MEDIAX_792452-T2/images/I/51Y+t6U-44L._AC_UF894,1000_QL80_.jpg"
          class="d-block w-100" style="height:500px; object-fit: cover; object-position:center" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Sukuna</h5>
          <p>JJK Bad But Hero</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <hr>
  <div class="container d-flex justify-content-center  " id="Products">
    <h1>Products</h1>
  </div>



  <div class="row row-cols-1 row-cols-md-4 g-5 " style="margin: 25px;">

    <?php
            $result = mysqli_query($con, "SELECT * FROM products");
            while ($product = mysqli_fetch_assoc($result)) {
                  $productCode = $product['code'];
                  $productName = $product['name'];
                  $productPrice = $product['price'];
                  $productImage = $product['image'];
                  $productd= $product['product_d'];
                 
              echo '
              <div class="col">
                  <div class="card h-100">
                      <img src="' . $productImage . '" class="card-img-top h-100" alt="...">
                      <div class="card-body">
                          <h5 class="card-title">' . $productName . '</h5>
                          <p class="card-text">'.$productd.'</p>
                          <h6 class="card-text">$'.$productPrice.'</h6>
                          <form method="post">
                              <input type="hidden" name="action" value="add">
                              <input type="hidden" name="code" value="' . $productCode . '">
                              <button type="submit" class="btn btn-primary card-text">Add to Cart</button>
                          </form>
                      </div>
                  </div>
              </div>'; 
            }
            mysqli_close($con);
        ?>
  </div>
  <hr>
  <div class="container d-flex justify-content-center " id="team">
    <h1>Our Team</h1>
  </div>

  <div style="display:grid; grid-template-columns: auto auto; margin:50px;" class="">
    <div class="card mb-3" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-4">
          <img
            src="https://img.freepik.com/premium-vector/young-man-anime-style-character-vector-illustration-design-manga-anime-boy_147933-4708.jpg?w=2000"
            class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8" style="display: flex; justify-content: center ; align-items: center;">
          <div class="card-body">
            <h5 class="card-title">Rahul Singla</h5>
            <h6 class="card-text">Front-end Developer</h6>
            <h6 class="card-text"> <a href="https://www.instagram.com/rahul_singla_111/"
                style="text-decoration: none; color: black;"><i class="bi bi-instagram"></i> rahul_singla_111</a></h6>

          </div>
        </div>
      </div>
    </div>
    <div class="card mb-3" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-4">
          <img
            src="https://img.freepik.com/premium-vector/young-man-anime-style-character-vector-illustration-design-manga-anime-boy_147933-4678.jpg?w=360"
            class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8" style="display: flex; justify-content: center ; align-items: center;">
          <div class="card-body">
            <h5 class="card-title">Deepak Kumar</h5>
            <h6 class="card-text">Project Manager</h6>
            <h6 class="card-text"> <a href="https://www.instagram.com/computertime1/"
                style="text-decoration: none; color: black;"><i class="bi bi-instagram"></i> computertime1</a></h6>

          </div>
        </div>
      </div>
    </div>
    <div class="card mb-3" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-4">
          <img
            src="https://img.freepik.com/premium-vector/young-man-anime-style-character-vector-illustration-design-manga-anime-boy_147933-4716.jpg?w=360"
            class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8" style="display: flex; justify-content: center ; align-items: center;">
          <div class="card-body">
            <h5 class="card-title">Ankush</h5>
            <h6 class="card-text">Back-end Developer</h6>
            <h6 class="card-text"> <a href="https://www.instagram.com/_ankush.jangra_/"
                style="text-decoration: none; color: black;"><i class="bi bi-instagram"></i> _ankus.jangra_</a></h6>

          </div>
        </div>
      </div>
    </div>
    <div class="card mb-3" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-4 ">
          <img
            src="https://img.freepik.com/premium-vector/young-man-anime-style-character-vector-illustration-design-manga-anime-boy_147933-4693.jpg?w=2000"
            class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8" style="display: flex; justify-content: center ; align-items: center;">
          <div class="card-body">
            <h5 class="card-title">Rahul Dhiman</h5>
            <h6 class="card-text">CEO</h6>
            <h6 class="card-text"> <a href="https://www.instagram.com/rahuldhimanhere/"
                style="text-decoration: none; color: black;"><i class="bi bi-instagram"></i> rahuldhimanhere</a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <hr>
  <div class="container d-flex justify-content-center align-items-center " id="join">
    <h1>Join Us</h1>
</div>
<div class="container d-flex justify-content-center align-items-center" id="us">
    <h1></h1>
</div>
<div class="row row-cols-1 row-cols-md-4 g-1">
    <div class="col d-flex justify-content-center align-items-center" style="font-size: 125px; color: rgb(68, 68, 232);">
        <i class="bi bi-shield-fill"></i>
    </div>
    <div class="col d-flex flex-column justify-content-center align-items-center">
        <h4>Quick Start</h4>
        <div style="margin-top: 25px;">
            <p><a style="color: black; text-decoration: none;" href="#">Home</a></p>
            <p><a style="color: black; text-decoration: none;" href="#Products">Products</a></p>
            <p><a style="color: black; text-decoration: none;" href="#team">Our Team</a></p>
            <p><a style="color: black; text-decoration: none;" href="#about">About us</a></p>
        </div>
    </div>
    <div class="col d-flex flex-column justify-content-center align-items-center">
        <h4>Contact Us</h4>
        <div style="margin-top: 25px;">
            <p>+91 9812770201</p>
            <p>sureshsingla@gmail.com</p>
            <p><i class="bi bi-facebook"></i> Rahul Singla</p>
            <p><i class="bi bi-instagram"></i> rahul_singla_111</p>
        </div>
    </div>
    <div class="col d-flex flex-column justify-content-center align-items-center ">
        <h4>Toys</h4>
        <div style="margin-top: 25px;">
            <p>Anima Character</p>
            <p>Maraval Charater</p>
            <p>South Movies toys</p>
            <p>Logo Toys</p>
        </div>
    </div>
</div>

  <div
    style="display: flex; flex-direction: column; justify-content: center; align-items: center; background-color: rgb(36, 36, 36); padding: 5px; font-size: 20px; color: white;">
    <p>
      All right are claim - 2023
    </p>
    <p>
      By Rahul Singla
    </p>
  </div>
</body>

</html>