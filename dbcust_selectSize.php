<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "WhateverPassword"; //default ""

    $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $no_cart = $_GET['no_cart'];
    $size = $_GET['size'];

    $sql = $conn->prepare("UPDATE `cart` SET `size`=? WHERE `no_cart`=? ;");
    $sql->bindParam(1, $size, PDO::PARAM_STR);
    $sql->bindParam(2, $no_cart, PDO::PARAM_STR);

    $sql->execute();
    echo "SIZE UPDATED!";
    $conn = null;
} catch (PDOException $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}
?>