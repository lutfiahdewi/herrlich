<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "WhateverPassword"; //default ""

    $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST["name"];
    $sex = $_POST["sex"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $password = hash('sha384', $_POST["password"]);
    $province = $_POST["province"];
    $city = $_POST["city"];
    $address = $_POST["address"];
    $no_telp = $_POST["no_telp"];

    //tambah data ke dalam tabel account
    $sql = $conn->prepare("INSERT INTO `account` (`name`, `sex`, `dob`, `email`, `password`,
     `province`, `city`,`address`, `no_telp`) VALUES (?,?,?,?,?,?,?,?,?
     );");
    $sql->bindParam(1, $name, PDO::PARAM_STR);
    $sql->bindParam(2, $sex, PDO::PARAM_STR);
    $sql->bindParam(3, $dob, PDO::PARAM_STR);
    $sql->bindParam(4, $email, PDO::PARAM_STR);
    $sql->bindParam(5, $password, PDO::PARAM_STR);
    $sql->bindParam(6, $province, PDO::PARAM_STR);
    $sql->bindParam(7, $city, PDO::PARAM_STR);
    $sql->bindParam(8, $address, PDO::PARAM_STR);
    $sql->bindParam(9, $no_telp, PDO::PARAM_STR);

    $sql->execute();

    echo "
     <script>
         alert('Berhasil registrasi, silahkan sign in');
         document.location.href='signin.php';
     </script>";

    $conn = null;
} catch (PDOException $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}
