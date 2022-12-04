<?php include('header.php');
if (!isset($_SESSION['slot'])) {
    header("Location: signin.php");
}
try {
    $servername = "localhost";
    $username = "root";
    $password = "WhateverPassword"; //default ""

    $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //ambil data di cart berdasarkan slot pengguna, produk yang dimasukkan cart
    $slot = $_SESSION['slot'];

    $sql = $conn->prepare("SELECT * FROM `cart` WHERE `slot`=?;");
    $sql->bindParam(1, $slot, PDO::PARAM_STR);

    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $sql->fetchAll();

    //var_dump($rows);

    //$conn->commit();
    //setelah dapat beberapa id_product, cari detailnya di db products
    $sql2 = $conn->prepare("SELECT * FROM `products` WHERE `product_id` LIKE ?");
    $products = array();
    foreach ($rows as $cart) {
        $sql2->bindParam(1, $cart['product_id'], PDO::PARAM_STR);
        $sql2->execute();
        $sql2->setFetchMode(PDO::FETCH_ASSOC);
        array_push($products, $sql2->fetch());
    }
    //var_dump($products);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <script>
            document.getElementsByTagName('a')[4].classList.add('active');
        </script>
    </head>

    <body>
        <div id="title" class="section-p1">
            <h2>Cart</h2>
        </div>

        <section id="cart" class="section-p1">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Remove</td>
                        <td>Image</td>
                        <td>Product</td>
                        <td>Size</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Subtotal</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $total = 0;
                    foreach ($products as $detail) {
                        //$subtotal = $detail["retail_price"] * $rows[$i]["quantity"];
                        $total += $rows[$i]["subtotal"];
                        echo ' 
                        <tr>
                            <td><img src="img/trash.png" alt="" class="icon" 
                                onclick="deleteCart(\''.$rows[$i]["no_cart"].'\')" ></td>
                            <td><img src="'.$detail["product_picture"].'" alt=""></td>
                            <td>'.wordwrap($detail["title"], 25, "<br>", false).'</td>
                            <td>
                                <select name="size" id="size" class="size"
                                onchange="selectSize(\''.$rows[$i]["no_cart"].'\',this.value)">
                                    <option disabled value="" selected></option>
                                    <option value="S" class="S">S</option>
                                    <option value="M" class="M">M</option>
                                    <option value="L" class="L">L</option>
                                    <option value="XL" class="XL">XL</option>
                                    <option value="XXL" class="XXL">XXL</option>
                                </select>
                            </td>
                            <td>&euro; '.$detail["retail_price"].'</td>
                            <td><input type="number" class="subtotal-product" value="'.$rows[$i]["quantity"].'" 
                            onchange="changeQuantity(\''.$rows[$i]["no_cart"].'\',this.value,\''.$detail["retail_price"].'\','.$i.')"></td>
                            <td class="subtotal-pro" >'.$rows[$i]["subtotal"].'</td>
                        </tr>
                        ';
                        if($rows[$i]["size"]){
                            echo '<script>
                            document.getElementsByClassName("'.$rows[$i]["size"].'")['.$i.'].selected = true;
                            </script>';
                        }
                        $i++;
                    }
                    ?>
                    

                </tbody>
            </table>
        </section>

        <section id="cart-add" class="section-p1">
            <div id="coupon">
                <h3>Apply Coupon</h3>
                <div>
                    <input type="text" placeholder="Enter Your Coupon">
                    <button id="submit-btn">Apply</button>
                </div>
            </div>
            <div id="subtotal">
                <h3>Cart Total</h3>
                <table>
                    <tr>
                        <td>Cart Subtotal</td>
                        <td id="cart-subtotal"><?php echo $total; ?></td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td id="cart-total"><strong>&euro;. <?php echo $total; ?>,-</strong></td>
                    </tr>
                </table>
                <button id="submit-btn" onclick="checkOut()">Proceed to checkout</button>
            </div>
        </section>

    <?php
    $conn = null;
} catch (PDOException $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}
include('footer.php');
    ?>

    </body>

    </html>