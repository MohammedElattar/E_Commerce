<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?= FRONT_ASSETS ?>css/login.css" />
  <title><?= $data['title'] ?></title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form class="sign-in-form login-frm">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username Or Email" name="user" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="pass" />
          </div>
          <button type="submit" class="btn solid login-btn">Login</button>
          <p class="social-text">Or</p>
          <div class="social-media">
            <a href="<?=ROOT?>login/GoogleAuth" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
          </div>
        </form>
        <form action="#" class="sign-up-form signup-frm">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" name="username" />
          </div>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Your Full Name" name="name" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="pass" />
          </div>
          <button type="submit" class="btn signup-btn">Sign Up</button>
          <p class="social-text">Or</p>
          <div class="social-media">
            <a href="<?=ROOT?>login/GoogleAuth" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
          </div>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>

          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="<?= FRONT_ASSETS ?>img/login/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>

          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="<?= FRONT_ASSETS ?>img/login/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="<?= FRONT_ASSETS ?>js/login.js"></script>
</body>

</html>