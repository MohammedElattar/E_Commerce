<?php $this->view("header" , $data) ?>

<section id="page-header" class="about-header">

    <h2>#let's_talk</h2>

    <p>LEAVE A MESSAGE, WE LOVE TO HEAR FROM YOU!</p>

</section>

<section id="cart" class="section-p1 d-flex flex-column">
    <?php if (isset($_SESSION['tmp_cart']) && $_SESSION['tmp_cart']):?>
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Product</td>
                <td>Price</td>
                <td>Qty</td>
                <td>Avilable Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($_SESSION['tmp_cart'] as $i): ?>
            <tr>
                <td><a href="" id='rm-cart-item' data-id="<?=$i['id']?>"><i class="far fa-times-circle"></i></a></td>
                <td><img src="<?=ROOT?>uploads/products/<?= $i['image'] ?>" alt="<?= $i['name'] ?>"></td>
                <td><?= $i['name'] ?></td>
                <td>EGP <?= $i['price'] ?></td>
                <td><input type="number" value="<?= $i['quantity'] ?>" min='1' max="<?=$i['total_qty']?>"></td>
                <td><?= $i['total_qty'] ?></td>
                <td>EGP <?= $i['price'] * $i['quantity'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a id='update-crt' class="btn btn-primary align-self-center mt-5" onclick='updateCrt(event)'>Update Cart</a>
    <?php else :?>
        <span class="alert alert-info font-weight-bold text-center">There is no items in your cart , please add items to show it</span>
    <?php endif?>
</section>
<?php if(isset($_SESSION['tmp_cart']) && $_SESSION['tmp_cart']): ?>
<section id="cart-add" class="section-p1">
    <div id="subtotal">
        <h3>Cart Total</h3>
        <table>
            <tr>
                <td>shipping</td>
                <td>Free</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>
                    <?php
                    $total=  0;
                    foreach($_SESSION['tmp_cart'] as $i)
                        $total+=($i['price'] * $i['quantity']);
                    echo $total;
                    ?>
                </strong></td>
            </tr>
        </table>
        <a href="<?=ROOT?>checkout" class="btn btn-primary">Place to order</a>
    </div>

</section>
<?php endif ?>

<?php $this->view("footer") ?>