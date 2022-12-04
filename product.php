<?php include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        document.getElementsByTagName('a')[2].classList.add('active');
    </script>
</head>

<body>
    <section id="pro-detail">
        <div class="single-pro-image">
            <img src="img/products/f1.jpg" width="100%" id="MainImg" alt="">
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="img/products/f1.jpg"  alt="" class="SmallImg">
                </div>
                <div class="small-img-col">
                    <img src="img/products/f2.jpg"  alt=""  class="SmallImg">
                </div>
                <div class="small-img-col">
                    <img src="img/products/f3.jpg"  alt=""  class="SmallImg">
                </div>
                <div class="small-img-col">
                    <img src="img/products/f4.jpg"  alt=""  class="SmallImg">
                </div>

            </div>
        </div>
        <div class="single-pro-details">
            <h6>Home</h6>
            <h4>Title</h4>
            <h2>price</h2>
            <select name="" id="">
                <option value="">S</option>
                <option value="">M</option>
                <option value="">L</option>
                <option value="">XL</option>
                <option value="">XXL</option>
            </select>
            <input type="number" value="1">
            <button id="submit-btn">Add To Cart</button>
            <h4>Product Details</h4>
            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                Mollitia non ducimus inventore reiciendis! Mollitia, officiis 
                natus! Distinctio aspernatur beatae enim, repellat dolor, inventore 
                eveniet quis atque, recusandae numquam nisi laboriosam!</span>
        </div>
    </section>
    <section id="product" class="section-p1">
        <h2>Featured Product</h2>
        <p>Other Product You May Also Like</p>
        <div class="pro-container">
            <!-- kotak produk -->
            <div class="pro">
                <img src="img/products/f1.jpg" alt="">
                <div class="des">
                    <span>adidas</span>
                    <h5>Cartoon Astrounout T-Shiert</h5>
                    <div class="star">
                        <span class="rating">4.5</span>
                        <img src="img/starIcon.png" alt="">
                    </div>
                    <h4>399.000</h4>
                </div>
                <a href=""><img src="img/addCart.png" alt="" class="cart"></a>
            </div>
            <div class="pro">
                <img src="img/products/f1.jpg" alt="">
                <div class="des">
                    <span>adidas</span>
                    <h5>Cartoon Astrounout T-Shiert</h5>
                    <div class="star">
                        <span class="rating">4.5</span>
                        <img src="img/starIcon.png" alt="">
                    </div>
                    <h4>399.000</h4>
                </div>
                <a href=""><img src="img/addCart.png" alt="" class="cart"></a>
            </div>
            <div class="pro">
                <img src="img/products/f1.jpg" alt="">
                <div class="des">
                    <span>adidas</span>
                    <h5>Cartoon Astrounout T-Shiert</h5>
                    <div class="star">
                        <span class="rating">4.5</span>
                        <img src="img/starIcon.png" alt="">
                    </div>
                    <h4>399.000</h4>
                </div>
                <a href=""><img src="img/addCart.png" alt="" class="cart"></a>
            </div>
            <!-- kotak produk -->
        </div>
    </section>


    <?php include('footer.php') ?>
</body>

</html>