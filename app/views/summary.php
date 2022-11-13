<?= $this->view("header" , $data) ?>
<div class="text-center" style="margin: 100px auto;">
<?php if (isset($_SESSION['checkout-result']['success'])) :?>
<div class="alert alert-success" style="width:100%;margin: 100px auto">Your Order Has Been Created Successfully , We Will Contact With You Soon</div>
<div class="alert alert-info" style="width:100%;margin: 100px auto">Redirect in 10 seconds</div>
<?php unset($_SESSION['tmp_cart']); header("Refresh:10;url=".ROOT)?>
<?php else : ?>
<div class="alert alert-danger" style="width:100%;margin: 100px auto">There Are Some Products With Bigger Quantity , Check The Cart <a href="<?=ROOT?>cart">Here</a> </div>
<?php endif ?>
</div>
<?= $this->view("footer") ?>