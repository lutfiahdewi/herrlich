<?php
    try {
        $servername = "localhost";
        $username = "root";
        $password = "WhateverPassword"; //default ""

        $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
        //set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $no_cart = $_GET['no_cart'];
        $quantity = $_GET['quantity'];
        $subtotal = $_GET['price'] * $quantity;

        $sql = $conn->prepare("UPDATE `cart` SET `quantity`=?, `subtotal`=? WHERE `no_cart`=? ;");
        $sql->bindParam(1, $quantity, PDO::PARAM_STR);
        $sql->bindParam(2, $subtotal, PDO::PARAM_STR);
        $sql->bindParam(3, $no_cart, PDO::PARAM_STR);

        $sql->execute();
        // echo "QUANTITY UPDATED!";
        echo $subtotal;
        $conn = null;
    } catch (PDOException $e) {
        echo "Terjadi Kesalahan: " . $e->getMessage();
    }
?>
