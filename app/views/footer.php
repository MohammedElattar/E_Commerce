<footer class="section-p1">
    <div class="col">
        <img class="logo" src="img/Picsart_22-08-06_02-17-05-128.png" alt="">
        <h4>Contact</h4>
        <p><strong>Address: </strong> king faisal st,giza governorate</p>
        <p><strong>phone:</strong>+201025866582 / +201021297818</p>
        <p><strong>Houurs:</strong> 10:00 - 22:00, Mon - Sun</p>
        <div class="follow">
            <h4>Follow Us</h4>
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <h4>About</h4>
        <a href="#">About use</a>
        <a href="#">Delivery Infomation</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms & Conditions</a>
        <a href="#">Contact Us</a>
    </div>

    <div class="col">
        <h4>My Account</h4>
        <a href="<?=ROOT?><?= isset($_SESSION['client']['id']) ? 'logout' : 'login' ?>"><?= isset($_SESSION['client']['id']) ? 'Logout' : 'Login' ?></a>
        <a href="<?= ROOT ?>admin/login">Admin Portal</a>
        <a href="#">View Cart</a>
        <a href="#">My Wishlist</a>
        <a href="#">Track My Order</a>
        <a href="#">help</a>
    </div>

    <div class="col install">
        <h4>Install App</h4>
        <p>From App Store or Google play</p>
        <div class="row">
            <img src="img/pay/app.jpg" alt="">
            <img src="img/pay/play.jpg" alt="">
        </div>
        <p>Secured Payment Geteways</p>
        <img src="img/pay/pay.png" alt="">
    </div>

    <div class="copyright">
        <p>© 2022, Youssef Ammar - HTML CSS Ecommerce Template</p>
    </div>
</footer>

<script src="<?= FRONT_ASSETS ?>js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/js/bootstrap.min.js" integrity="sha512-vyRAVI0IEm6LI/fVSv/Wq/d0KUfrg3hJq2Qz5FlfER69sf3ZHlOrsLriNm49FxnpUGmhx+TaJKwJ+ByTLKT+Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?=FRONT_ASSETS?>js/ajax.js"></script>
<script src="<?= FRONT_ASSETS ?>js/script.js"></script>
</body>
</html>