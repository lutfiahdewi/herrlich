<?php include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
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
    LIMIT 30;");

    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $sql->fetchAll();

    //var_dump($rows);


?>

    <head>
        <script>
            document.getElementsByTagName('a')[2].classList.add('active');
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


        <section id=page-header>
            <h2>#stayhome</h2>
            <p>Save more with coupons & up to 70% off!</p>
        </section>

        <section id="search" class="section-p1">
            <input type="text" name="keyword" id="keyword" placeholder="Type to search..." onkeyup="searchProduct()">
        </section>

        <section id="product" class="section-p1">
            <div class="pro-container" id="pro-container">
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
                onclick="addToCart(\'' .$product["product_id"]. '\',\'' .$product["retail_price"]. '\')">
            </div>
            ';
                }
                ?>
                <!-- kotak produk -->
            </div>
        </section>

        <!-- <section id="pagination" class="section-p1">
            <a class="page-num" href="#">1</a>
            <a href="shop2.php">2</a>
            <a href="shop3.php">3</a>
        </section> -->

    <?php
    $conn = null;
    } catch (PDOException $e) {
        echo "Terjadi Kesalahan: " . $e->getMessage();
    }
include('footer.php');
    ?>

    </body>

</html>