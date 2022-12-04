<?php
session_start();


try {
    $servername = "localhost";
    $username = "root";
    $password = "WhateverPassword"; //default ""

    $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = $_POST["email"];
    $password = hash('sha384', $_POST["password"]);

    //cek name
    $sql = $conn->prepare("SELECT * FROM `account` WHERE email=?");
    $sql->bindParam(1, $email, PDO::PARAM_STR);

    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $row = $sql->fetch();
    
    //jika name ditemukan
    if($row){
        if($password===$row["password"]){
            //password benar
            $_SESSION['slot'] = $row['slot'];
            header("Location: index.php");
        }
        else{
            echo"
        <script>
            alert('Email/password salah');
            document.location.href='signin.php';
        </script>
        ";
        }
    }
    else{
        echo"
        <script>
            alert('Email/password salah');
            document.location.href='signin.php';
        </script>
        ";
    }
    $conn = null;
} catch (PDOException $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}

?>