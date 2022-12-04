<?php
session_start();
try {
    $servername = "localhost";
    $username = "root";
    $password = "WhateverPassword"; //default ""

    $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $slot = $_SESSION['slot'];

    //ambil data di cart berdasarkan slot pengguna dan dimasukkan ke orders
    $sql = $conn->prepare("INSERT INTO `orders` (`slot`,`product_id`,`size`,`quantity`,`subtotal`)    
    SELECT `slot`,`product_id`,`size`,`quantity`, `subtotal`    
    FROM `cart`    WHERE `slot`=?;");
    $sql->bindParam(1, $slot, PDO::PARAM_STR);
    $sql->execute();

    //tambahkan order_id 
    $order_id = rand(100000, 999999);
    $sql1 = $conn->prepare("UPDATE `orders` SET `order_id`=? WHERE `slot`=? AND `order_id`=0;");
    $sql1->bindParam(1, $order_id, PDO::PARAM_STR);
    $sql1->bindParam(2, $slot, PDO::PARAM_STR);
    $sql1->execute();

    // $sql->setFetchMode(PDO::FETCH_ASSOC);
    // $rows = $sql->fetchAll();

    //delete produk di cart
    $sql2 = $conn->prepare("DELETE FROM `cart` WHERE `slot` = ?");
    $sql2->bindParam(1, $slot, PDO::PARAM_STR);
    $sql2->execute();

    echo "ORDER CREATED";
    $conn = null;
    header("Location: track.php");
} catch (PDOException $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}
