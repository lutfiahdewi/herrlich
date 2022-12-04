<?php include('header.php');
if (isset($_SESSION['slot'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <section id="registration" class="section-p1">
        <div class="form-container">
        <h3>Create Account</h3>
        <form action="dbcust_regis.php" id="Form" onsubmit="return validate()" method="post">
            <label>Nama Lengkap : <br>
            <input name="name" id="name" type="text"  value="" required><br></label>

            <label>Jenis Kelamin : <br>
            <select name="sex" id="sex" required>
            <option disabled selected value> -- select an option -- </option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select><br></label>
            
            <label>Tanggal lahir : <br>
            <input name="dob" id="dob" type="date" value="" required><br></label>
            
            <label>Alamat email : <br>
            <input name="email" type="text" id="email"  value="" required><br></label>
            
            <label>Password : <br>
            <input name="password" type="password" id="password"  value="" required><br></label>

            <label>Provinsi : <br>
            <input name="province" id="province" type="text"  value="" required><br></label>

            <label>Kabupaten/kota : <br>
            <input name="city" id="city" type="text"  value="" required><br></label>

            <label>Alamat rumah : <br>
            <textarea name="address" id="address" required></textarea>
            <br></label>

            <label>Nomor telepon : <br>
            <input name="no_telp" id="telp" type="text"  value="" required><br></label>
        </form>
        <button id="submit-btn" type="submit" form="Form" value="Submit">Register</button>
        <div id="errorMessagesBox"></div>
    </div>
        
    </section>


    <?php include('footer.php') ?>
</body>

</html>