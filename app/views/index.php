<?php
$this->view("header", $data);
$feathered = $data['feathered'];
$arrivals = $data['arrivals'];
?>

<body>

  <section id="hero">
    <h4>trad-in-offer</h4>
    <h2>super value deals</h2>
    <h1>on all products</h1>
    <p>save more with coupons & up to 30% off!</p>
    <button class="shp-now">Shop Now</button>
  </section>

  <section id="feature" class=".section-p1">
    <div class="fe-box">
      <img src="<?= FRONT_ASSETS ?>img/features/f1.png" alt="">
      <h6>Free Shipping</h6>
    </div>
    <div class="fe-box">
      <img src="<?= FRONT_ASSETS ?>img/features/f2.png" alt="">
      <h6>Online Order</h6>
    </div>
    <div class="fe-box">
      <img src="<?= FRONT_ASSETS ?>img/features/f3.png" alt="">
      <h6>Save Mony</h6>
    </div>
    <div class="fe-box">
      <img src="<?= FRONT_ASSETS ?>img/features/f4.png" alt="">
      <h6>Promotions</h6>
    </div>
    <div class="fe-box">
      <img src="<?= FRONT_ASSETS ?>img/features/f5.png" alt="">
      <h6>Happy Sell</h6>
    </div>
  </section>

  <section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">
      <?php if ($feathered) : ?>

        <?php foreach ($feathered as $i) : ?>
          <div class="pro">
            <a href="<?= ROOT ?>home/product_details?id=<?= $i['id'] ?>">
              <img src="<?= ROOT ?>uploads/products/<?= json_decode($i['images'])[0] ?>" alt=""></a>
            <div class="des">
              <span>
                <?= $i['cat_name'] ?>
              </span>
              <h5>
                <?= $i['name'] ?>
              </h5>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4>EGP
                <?= $i['price'] ?>
              </h4>
            </div>
            <a href="" id="add-crt" data-id="<?= $i['id'] ?>"><i class="fa-solid fa-cart-plus cart"></i></i></a>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="alert alert-info" style="width:100%">There are no products from the store , check later 🙃</div>
      <?php endif ?>
    </div>
  </section>

  <section id="banner" class="section-m1">
    <h4>Repair Services</h4>
    <h2>Up to<span>30% Off</span>- All t-shirt & Accessories</h2>
    <button class="normal">Explore More</button>
  </section>

  <section id="product1" class="section-p1">
    <h2>New Arrivals</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">
      <?php if ($arrivals) : ?>
        <?php foreach ($arrivals as $i) : ?>
          <div class="pro">
            <a href="<?= ROOT ?>home/product_details?id=<?= $i['id'] ?>"><img src="<?= ROOT ?>uploads/products/<?= json_decode($i['images'])[0] ?>" alt=""></a>
            <div class="des">
              <span>
                <?= $i['cat_name'] ?>
              </span>
              <h5>
                <?= $i['name'] ?>
              </h5>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4>EGP
                <?= $i['price'] ?>
              </h4>
            </div>
            <a href="" id="add-crt" data-id="<?= $i['id'] ?>"><i class="fa-solid fa-cart-plus cart"></i></i></a>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="alert alert-info" style="width:100%">There is not comming products soon , check it later 🙃</div>
      <?php endif ?>
    </div>
  </section>

  <section id="sm-banner" class="section-p1">
    <div class="banner-box">
      <h4>Crazy deals</h4>
      <h2>by 3 get 1 free</h2>
      <span>The best regular t-shirt & oversize is on sale at theme store</span>
      <button class="white">Learn More</button>
    </div>
    <div class="banner-box banner-box2">
      <h4>spring/summer</h4>
      <h2>upcomming season</h2>
      <span>The best regular t-shirt & oversize is on sale at theme store</span>
      <button class="white">Collection</button>
    </div>
  </section>


  <section id="banner3">
    <div class="banner-box">
      <h2>SEASONAL SALE</h2>
      <h3>Winter Collection -30% OFF</h3>
    </div>
    <div class="banner-box banner-box2">
      <h2>NEW FOOTWEAR COLLECTION</h2>
      <h3>Spring / Summer 2022</h3>
    </div>
    <div class="banner-box banner-box3">
      <h2>T-SHIRTS</h2>
      <h3>New Trendy Prints</h3>
    </div>
  </section>

  <section id="newsletter" class="section-p1 section-m1">
    <div class="newtext">
      <h4>Sign Up For Newletters</h4>
      <p>Get E-mail Updates about our latest shop and<span>special offers.</span>
      </p>
    </div>
    <div class="from">
      <input type="text" placeholder="your email address">
      <button class="normal">Sign Up</button>
    </div>
  </section>

  <?= $this->view("footer") ?>
  <script>
    $(".shp-now").on("click", e => {
      window.location.replace(`<?= ROOT ?>+"shop"`)
    })
  </script>