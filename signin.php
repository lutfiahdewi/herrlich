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
        <h3>Sign In</h3>
        <form action="dbcust_signin.php" id="form" onsubmit="return validate()" method="post">
            <label>Alamat email : <br>
            <input name="email" type="text" id="email" value="" required><br></label>
            
            <label>Password : <br>
            <input name="password" type="password" id="password" value="" required><br></label>
        </form>
        <button id="submit-btn" type="submit" form="form" value="Submit">Sign In</button>
    <p>Don't have an account? Create an account <a href="registration.php">here</a></p>    
    </div>
    </section>


    <?php include('footer.php') ?>
</body>

</html>