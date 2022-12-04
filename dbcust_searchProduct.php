<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "WhateverPassword"; //default ""

    $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $keyword = '%'.$_GET['keyword'].'%';

    //ambil data produk-produk
    //metode prepared stmt, gagal -> error : SQLSTATE[HY093]: Invalid parameter number: number of bound variables does not match number of tokens
    //padahal hanya ada 1 parameter dan sudah di bind
    // $sql = $conn->prepare("SELECT * FROM `products` WHERE `title` LIKE '?'
    // ORDER BY `units_sold` DESC, `rate` DESC, `inventory_total` DESC
    // LIMIT 30;");
    // $sql->bindParam(1, $keyword, PDO::PARAM_STR);
    // $sql->execute();
    // $sql->setFetchMode(PDO::FETCH_ASSOC);
    // $rows = $sql->fetchAll();

    //metode biasa
    $sql = "SELECT * FROM `products` WHERE `title` LIKE '$keyword' ORDER BY `units_sold` DESC, `rate` DESC, `inventory_total` DESC
    LIMIT 30;";

    $result = $conn->query("$sql");
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $result->fetchAll();

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

    //var_dump($rows);
    $conn = null;
} catch (PDOException $e) {
    echo $keyword.'<br>';
    //echo $success.'<br>';
    //echo $sql->debugDumpParams().'<br>';
    echo var_dump($rows).'<br>';
    echo "Terjadi Kesalahan: " . $e->getMessage();
}
?>