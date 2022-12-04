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
        $slot = $_SESSION['slot'];
        $order_id = $_GET['order_id'];

        $sql = $conn->prepare("DELETE FROM `orders` WHERE `slot` = ? AND `order_id` LIKE ?;");
        $sql->bindParam(1, $slot, PDO::PARAM_STR);
        $sql->bindParam(2, $order_id, PDO::PARAM_STR);

        $sql->execute();

        echo "CANCELED!";
        $conn = null;
    } catch (PDOException $e) {
        echo "Terjadi Kesalahan: " . $e->getMessage();
    }
?>