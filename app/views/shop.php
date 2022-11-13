<?php
$shop = $data['shop'];
$this->view("header",$data);
?>

<body>


  <section id="product1" class="section-p1">
    <div class="pro-container">
      <?php foreach($shop as $i): ?>
      <div class="pro">
        <a href="<?=ROOT?>home/product_details?id=<?= $i['id'] ?>"><img src="<?=ROOT?>uploads/products/<?=json_decode($i['images'])[0]?>" alt=""></a>
        <div class="des">
          <span>
            <?=$i['cat_name']?>
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
            <?=$i['price']?>
          </h4>
        </div>
        <a href="" id="add-crt" data-id="<?=$i['id']?>"><i class="fa fa-cart-plus cart"></i></a>
      </div>
      <?php endforeach;?>
  </div>
</section>

<section id="pagination" class="section-p1">
    <a href="#">1</a>
    <a href="#">2</a>
    <a href="#"><i class="fa-solid fa-square-caret-right"></i></a>
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