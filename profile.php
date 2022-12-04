<?php include('header.php');
if (!isset($_SESSION['slot'])) {
    header("Location: signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>

    <section id="profile" class="section-p1">
        <div id="title" class="section-p1">
            <h2>Profile</h2>
        </div>
        <div class="profile-container">
            <div class="buttons">
                <button id="submit-btn">Edit data</button>
                <a href="cart.php"><button id="submit-btn">Go to cart</button></a>
                <a href="track.php"><button id="submit-btn">Track order</button></a>
                <a href="dbcust_signout.php"><button id="submit-btn">Sign Out</button></a>
            </div>
            <form action="dbcust_regis.php" id="form" onsubmit="return validate()" method="post">
                <label>Nama Lengkap : <br>
                    <input name="name" id="name" type="text" value="" required disabled><br></label>

                <label>Jenis Kelamin : <br>
                    <select name="sex" id="sex" required disabled>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select><br></label>

                <label>Tanggal lahir : <br>
                    <input name="date" type="date" value="" required disabled><br></label>

                <label>Alamat email : <br>
                    <input name="email" type="text" id="email" value="" required disabled><br></label>

                <label>Provinsi : <br>
                    <input name="province" type="text" value="" required disabled><br></label>

                <label>Kabupaten/kota : <br>
                    <input name="city" type="text" value="" required disabled><br></label>

                <label>Alamat rumah : <br>
                    <textarea name="address" id="address" required disabled></textarea><br></label>

                <label>Nomor telepon : <br>
                    <input name="telp" type="text" value="" required disabled><br></label>
            </form>
            <div class="buttons">
            <button id="submit-btn" type="submit" form="form" value="Submit" disabled>Save</button>
            <button id="submit-btn" onclick="deleteAcc()">Delete Account</button>
        </div>
        </div>
    </section>


    <?php include('footer.php') ?>
</body>

</html>