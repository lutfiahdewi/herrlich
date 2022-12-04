<?php include('header.php');
try {
    $servername = "localhost";
    $username = "root";
    $password = "WhateverPassword"; //default ""

    $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //ambil data produk-produk
    $sql = $conn->prepare("SELECT * FROM `products` 
    ORDER BY `units_sold` DESC, `rate` DESC, `inventory_total` DESC
    LIMIT 9;");

    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $sql->fetchAll();

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <script>
            document.getElementsByTagName('a')[1].classList.add('active');
        </script>
    </head>

    <body>
        <section>
            <div class="popup" id="popup">
                <img src="img/check-wh.png" alt="Added to cart!">
                <h2>Added to Cart!</h2>
                <p>Set the size and quantity in the cart</p>
                <button type="submit" id="submit-btn" onclick="closePopup()">Ok</button>
            </div>
        </section>

        <section id=hero>
            <h4>Trade-in-offer</h4>
            <h2>Super value deals</h2>
            <h1>On all products</h1>
            <p>Save more with coupons & up to 70% off!</p>
            <a href="shop.php"><button>Shop Now</button></a>
        </section>

        <section id="feature" class="section-p1">
            <div class="fe-box">
                <img src="img/features/f1.png" alt="">
                <h6>Free Shipping</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f2.png" alt="">
                <h6>Online Order</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f3.png" alt="">
                <h6>Save Money</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f4.png" alt="">
                <h6>Promotion</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f5.png" alt="">
                <h6>Happy Sell</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f6.png" alt="">
                <h6>F24/7 Support</h6>
            </div>

        </section>

        <section id="product" class="section-p1">
            <h2>Featured Product</h2>
            <p>Best Selling</p>
            <div class="pro-container">
                <!-- kotak produk -->
                <?php
                foreach ($rows as $product) {
                    $product_id = $product["product_id"];
                    echo '
            <div class="pro" >
                <img src="' . $product["product_picture"] . '" alt="">
                <div class="des">
                    <span>' . $product["merchant_title"] . '</span>
                    <h5>' . $product["title"] . '</h5>
                    <div class="star">
                        <span class="rating">' . $product["rate"] . '</span>
                        <img src="img/starIcon.png" alt="">
                    </div>
                    <h4> &euro; ' . $product["retail_price"] . '</h4>
                </div>
                <img src="img/addCart.png" alt="" class="cart" 
                onclick="addToCart(\'' . $product["product_id"] . '\',\'' . $product["retail_price"] . '\')">
            </div>
            ';
                }
                ?>
                <!-- kotak produk -->
            </div>
        </section>

        <section id="sm-banner" class="section-p1">
            <div class="banner-box">
                <h4>crazy deals</h4>
                <h2>buy 1 get 1 free</h2>
                <span>The best classic dress is on sale at Herrlich</span>
                <button class="white">Learn More</button>
            </div>
            <div class="banner-box">
                <h4>spring/summer</h4>
                <h2>upcoming season</h2>
                <span>The best classic dress is on sale at Herrlich</span>
                <button class="white">Collection</button>
            </div>
        </section>

        <section id="banner2">
            <div class="banner-box">
                <h2>SEASONAL SALE</h2>
                <h3>Winter Collection -50% OFF</h3>
            </div>
            <div class="banner-box">
                <h2>NEW FOOTWEAR COLLECTION</h2>
                <h3>Spring/Summer 2022</h3>
            </div>
            <div class="banner-box">
                <h2>T-SHIRT</h2>
                <h3>New Trendy Prints</h3>
            </div>

        </section>

    <?php
    $conn = null;
} catch (PDOException $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}
include('footer.php') ?>
    </body>

    </html>