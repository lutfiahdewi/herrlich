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

    //hapus akun
    $sql = $conn->prepare("DELETE FROM `account` WHERE `slot`=?");
    $sql->bindParam(1, $slot, PDO::PARAM_STR);
    $sql->execute();

    $sql1 = $conn->prepare("DELETE FROM `cart` WHERE `slot`=?");
    $sql1->bindParam(1, $slot, PDO::PARAM_STR);
    $sql1->execute();

    $sql2 = $conn->prepare("DELETE FROM `orders` WHERE `slot`=?");
    $sql2->bindParam(1, $slot, PDO::PARAM_STR);
    $sql2->execute();

    echo "DELETED!";
    
    $conn = null;
    
    //hapus sesssion
    header("Location: dbcust_signout.php");
} catch (PDOException $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}
