<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herrlich Online Shop</title>
    <link rel="icon" type="image/x-icon" href="img/logo2.png">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <section id="header">
        <a href="index.php"><img src="img/logo1.png" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li id="shop-cat"><a href="shop.php">Shop</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li class="cart"><a href="cart.php"><img src="img/cart.png" class="icon" alt=""></a></li>
                <li class="cart"><a href="profile.php"><img src="img/accLogo.png" class="icon" alt=""></a></li>
                <a href="#"><img id="close" src="img/close.png" class="icon" alt=""></a>
            </ul>
        </div>
        <div class="mobile">
            <a href="cart.php"><img src="img/cart.png" class="icon" alt=""></a>
            <a href="profile.php"><img src="img/accLogo.png" class="icon" alt=""></a>
            <img id="bar" src="img/menubar.png" class="icon" alt=""
            >
            

        </div>
    </section>
        
</body>

</html>