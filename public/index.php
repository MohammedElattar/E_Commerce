<?php
require("../app/init.php");
ob_start();
$ar = explode("\\", getcwd());
if (session_id() == '') session_start();
DB::get_instance();
if ((isset($_SESSION['db_err']) && !$_SESSION['db_err']) || !DB::$err) {
    $app = new App();
} else header("Location:/" . $aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer . "/install.php");
ob_end_flush();
