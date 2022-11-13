<?php 
$this->view("header", $data);
$item = $data['data'];
$images = json_decode($item['images'] , true);
?>
<section id="prodetails" class="section-p1">
  <div class="single-pro-image">
    <img src="../uploads/products/<?=$images[0]?>" width="100%" id="MainImg"  alt="">

    <div class="small-img-group">
      <?php foreach($images as $i): ?>
      <div class="small-img-col">
        <img src="../uploads/products/<?=$i?>" width="100%" id="MainImg"  alt="">
      </div>
      <?php endforeach?>
    </div>
  </div>

  <div class="single-pro-details">
    <h6>Home / <?=$item['cat_name']?></h6>
    <h4><?= $item['name'] ?></h4>
    <h2>EGP <?= $item['price'] - (($item['discount'] * $item['price'])/100) ?></h2>
    <select>
      <option>Select Size</option>
      <option>XL</option>
      <option>XXL</option>
      <option>Small</option>
      <option>Large</option>
    </select>
    <div class="d-flex flex-direction-row align-items-center">
        <input type="number" value="1" min="1" max="<?= $item['quantity'] ?>">
        <a id="add-crt" data-id="<?= $item['id'] ?>" class="btn btn-primary">Add To Cart</a>
    </div>
    <h4>Product Details</h4>
    <span><?= $item['description'] ?></span>
  </div>
</section>

<section id="product1" class="section-p1">
  <h2>Featured Products</h2>
  <p>Summer Collection New Modern Design</p>
  <div class="pro-container">
    <div class="pro">
      <img src="<?=FRONT_ASSETS?>img/products/n1.jpg" alt="">
      <div class="des">
        <span>adidas</span>
        <h5>Cartoon Astronaut T-Shirts</h5>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h4>EGP 200.00</h4>
      </div>
       <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></i></a>
    </div>
    <div class="pro">
      <img src="<?=FRONT_ASSETS?>img/products/n2.jpg" alt="">
      <div class="des">
        <span>adidas</span>
        <h5>Cartoon Astronaut T-Shirts</h5>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h4>EGP 200.00</h4>
      </div>
       <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></i></a>
    </div>
    <div class="pro">
      <img src="<?=FRONT_ASSETS?>img/products/f6.jpg" alt="">
      <div class="des">
        <span>adidas</span>
        <h5>Cartoon Astronaut T-Shirts</h5>
        <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h4>EGP 200.00</h4>
      </div>
       <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></i></a>
    </div>
    
 
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