<footer class="section-p1">
    <div class="col">
        <img src="img/logo1.png" alt="" class="logo">
        <h4>Contact</h4>
        <p><strong>Email: </strong><a href="mailto: herllich@shop.com">herllich@shop.com</a></p>
        <p><strong>Phone: </strong>+62 812 1234 5678</p>
        <p><strong>Hours: </strong> 10:00 - 17:00, Mon - Fri</p>

    </div>
    <div class="col">
        <h4>My Account</h4>
        <a id="sign-in" href="signin.php">Sign In</a>
        <a href="cart.php">View Cart</a>
        <a href="track.php">Track My Order</a>
        <a href="help.php">Help</a>
        <p>Secured Payment Gateways</p>
        <img src="img/pay/pay.png" alt="">
    </div>
    <div class="copyright">
        <hr>
        <p>Lutfiah Kumala Dewi &copy; 2022<br>Inspired by Tech2 etc</p>
    </div>
<?php
if (isset($_SESSION['slot'])) {
    echo '
    <script>
        document.getElementById("sign-in").innerHTML = "Sign Out";
        document.getElementById("sign-in").href = "dbcust_signout.php";
    </script>
    ';
}
?>
</footer>
<script src="script.js"></script>