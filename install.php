<?php

$db_credentials = require_once __DIR__ . '/app/core/1232fcd8f7a9a7ee413574877f4389052661d356.php';
require_once __DIR__ . '/app/core/config.php';
require_once __DIR__ . '/app/core/database.php';
db::get_instance();
// gettings the current working directory
$aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer = explode("\\", getcwd());
$aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer = $aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer[count($aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer) - 1];
if (session_id() == '') {
    session_start();
}
if (DB::$err) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db_name = @htmlentities($_POST['db']) or null;
        $host = @htmlentities($_POST['host']) or null;
        $user = @htmlentities($_POST['user']) or null;
        $pass = @$_POST['pass'] or null;
        if ($db_name) {
            $host = $host ? $host : 'localhost';
            $user = $user ? $user : 'root';
            $pass = $pass ? $pass : '';
            $handle = fopen(__DIR__ . '/app/core/1232fcd8f7a9a7ee413574877f4389052661d356.php', 'w');
            fwrite($handle, "<?php\n return [ 'HOST' =>  '$host' , 'USER' => '$user' , 'PASS' => '$pass' , 'DB_NAME' => '$db_name'];");
            fclose($handle);

            // installing dependices of composer 
            `cd ../app/controllers/apis/PHPMailer && composer update`;
            `cd ../app/controllers/apis/google && composer update`;

            header('Location: /' . $aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer . '/public');
        } else {
            $_SESSION['db-empty'] = '1';
        }
    }
} else {
    header('Location:/' . $aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer . '/public');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Configration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css" integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="container" style="padding:100px 200px">
        <h1 class="text-center">Configure Connection</h1>
        <?php
        if (isset($_SESSION['db-empty'])) {
            echo '<div class="alert alert-danger text-center" style="font-weight:bold;">Database Cannot Be Empty</div>';
            session_unset();
        }
        ?>
        <div class="alert alert-info text-center" style="font-weight: bold;">Leave HOST , User , Password If You Are On Local Machine <br> If you submitted the form and get redirected here again , that mean that db doesn't exists</div>
        <form method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Database Name</label>
                <input type="text" class="form-control" name="db" value="" autofocus>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">HOST</label>
                <input type="text" class="form-control" name="host" value="localhost">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User</label>
                <input type="text" class="form-control" name="user" value="root">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" value="">
            </div>
            <button type="submit" class="btn btn-primary">Configure</button>
        </form>
    </div>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.min.js" integrity="sha512-5BqtYqlWfJemW5+v+TZUs22uigI8tXeVah5S/1Z6qBLVO7gakAOtkOzUtgq6dsIo5c0NJdmGPs0H9I+2OHUHVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>