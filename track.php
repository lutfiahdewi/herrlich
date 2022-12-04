<?php include('header.php');
if (!isset($_SESSION['slot'])) {
    header("Location: signin.php");
}
class Orders
{
    public int $id;
    public String $products;
    public int $total;
    public  $date;
    public  $estdate;

    function __construct($id, $date)
    {
        $this->id = $id;
        $this->total = 0;
        $this->date = $date;
        $this->estdate = $date + 604800;
    }

    function addProduct($product)
    {
        if (!isset($products)) {
            $this->products = $product;
        } else {
            $this->products += ", " . $product;
        }
    }

    function addTotal($subtotal)
    {
        $this->total += $subtotal;
    }

    // function seDate($date){
    //     $this->date = $date;
    //     $this->estdate = $date + 604800;
    // }
}
try {
    $servername = "localhost";
    $username = "root";
    $password = "WhateverPassword"; //default ""

    $conn = new PDO("mysql:host=$servername;dbname=herrlich", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //ambil data di orders berdasarkan slot pengguna
    $slot = $_SESSION['slot'];

    $sql = $conn->prepare("SELECT * FROM `orders` WHERE `slot`=?;");
    $sql->bindParam(1, $slot, PDO::PARAM_STR);

    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $sql->fetchAll();

    // foreach($detail as $rows){
    //     $obj_name = "_" + $detail["order_id"];
    //     if($$obj_name){
    //         $$obj_name.addProduct($detail["product_id"]);
    //         $$obj_name.addTotal($detail["subtotal"]);

    //     }else{
    //         $$obj_name = new Orders($detail["order_id"], $detail["date"]);
    //     }
    // }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <script>
            document.getElementsByTagName('a')[5].classList.add('active');
        </script>
    </head>

    <body>
        <div id="title" class="section-p1">
            <h2>Track My Order</h2>
        </div>

        <section id="track" class="section-p1">
            <table width="100%">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Product(s)</td>
                        <td>Total price</td>
                        <td>Date</td>
                        <td>Est. Arrived</td>
                        <td>Cancel</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $detail) {
                        $estdate = date('Y-m-d', strtotime($detail["date"].' + 10 days'));
                        echo '
                    <tr>
                        <td>' . $detail["order_id"] . '</td>
                        <td>' . $detail["product_id"] . '</td>
                        <td>' . $detail["subtotal"] . '</td>
                        <td>' . $detail["date"] . '</td>
                        <td>' . $estdate . '</td>
                        <td><img src="img/cancel.png" alt="" class="icon" 
                            onclick="cancelOrder(\''.$detail["order_id"].'\')"></td>
                    </tr>
                    ';
                    }
                    ?>
                </tbody>
            </table>
        </section>

    <?php
} catch (PDOException $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
}
include('footer.php');
    ?>

    </body>

    </html>