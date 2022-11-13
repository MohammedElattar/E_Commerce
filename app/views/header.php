<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $data['title'] ?></title>
  <link rel="stylesheet" href="<?= FRONT_ASSETS ?>css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css" integrity="sha512-siwe/oXMhSjGCwLn+scraPOWrJxHlUgMBMZXdPe2Tnk3I0x3ESCoLz7WZ5NTH6SZrywMY+PB1cjyqJ5jAluCOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?= FRONT_ASSETS ?>css/style.css">
</head>
<section id="header">
  <a href="#"><img src="<?= FRONT_ASSETS ?>img/Picsart_22-08-06_02-17-05-128.png" class="logo" alt=""></a>
  <input type="hidden" value="<?= CWD ?>" id="cwd">

  <div>
    <ul id="navbar">
      <li><a class="active" href="<?= ROOT ?>">Home</a></li>
      <li><a href="<?= ROOT ?>home/shop">Shop</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="<?= ROOT ?>cart"><i class="fa-solid fa-cart-shopping"></i></a></li>
    </ul>
  </div>

</section>