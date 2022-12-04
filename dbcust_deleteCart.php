<?php
session_start();
    try {
        $servername = "localhost";
        $username = "root";
        $password = "WhateverPassword"; //default ""

        $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
        //set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //echo $_SESSION('slot');
        $no_cart = $_GET['no_cart'];
        $slot = $_SESSION['slot'];

        $sql = $conn->prepare("DELETE FROM `cart` WHERE `slot` = ? AND `no_cart` LIKE ?;");
        $sql->bindParam(1, $slot, PDO::PARAM_STR);
        $sql->bindParam(2, $no_cart, PDO::PARAM_STR);

        $sql->execute();

        echo "DELETED!";
        $conn = null;
    } catch (PDOException $e) {
        echo "Terjadi Kesalahan: " . $e->getMessage();
    }
?>
