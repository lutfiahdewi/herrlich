<?php
session_start();
if (!isset($_SESSION['slot'])) {
    echo "!LOGIN";
} else {
    try {
        $servername = "localhost";
        $username = "root";
        $password = "WhateverPassword"; //default ""

        $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
        //set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id_product = $_GET['id_product'];
        $price = $_GET['price'];
        $slot = $_SESSION['slot'];

        //cek dulu sudah ada kah barang yang sama oleh akun yang sama
        $sql = $conn->prepare("SELECT * FROM `cart` WHERE `slot` = ? AND `product_id` LIKE ?;");
        $sql->bindParam(1, $slot, PDO::PARAM_STR);
        $sql->bindParam(2, $id_product, PDO::PARAM_STR);

        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $duplicate = $sql->fetch();
        //var_dump($duplicate);

        // jika sudah ada, tinggal menambah quantity, jika belum ada, buat data baru ke cart
        if ($duplicate) {
            $quantity = $duplicate["quantity"] + 1;
            $subtotal = $quantity * $price;
            $sql1 = $conn->prepare("UPDATE `cart` SET `quantity`=?, `subtotal`=? 
                    WHERE `slot`=? AND `product_id` LIKE ?;");
            $sql1->bindParam(1, $quantity, PDO::PARAM_STR);
            $sql1->bindParam(2, $subtotal, PDO::PARAM_STR);
            $sql1->bindParam(3, $slot, PDO::PARAM_STR);
            $sql1->bindParam(4, $id_product, PDO::PARAM_STR);

            $sql1->execute();
            echo "UPDATED!";
        } else {
            //tambah data ke dalam tabel cart
            $sql2 = $conn->prepare("INSERT INTO `cart` (`slot`, `product_id`, `subtotal`) VALUES (?,?,?);");
            $sql2->bindParam(1, $slot, PDO::PARAM_STR);
            $sql2->bindParam(2, $id_product, PDO::PARAM_STR);
            $sql2->bindParam(3, $price, PDO::PARAM_STR);

            $sql2->execute();
            echo "INSERTED!";
        }
        $conn = null;
    } catch (PDOException $e) {
        echo "Terjadi Kesalahan: " . $e->getMessage();
    }
}
?>