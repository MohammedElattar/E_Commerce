<?php
$db_info = require __DIR__ . '/1232fcd8f7a9a7ee413574877f4389052661d356.php';

// gettings the current working directory
$aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer = explode("\\", getcwd());
$aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer = $aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer[count($aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer) - 2];

// Admin Root
define("URL", "{$_SERVER['HTTP_HOST']}");
define("CWD", $aaklsdjfhakljsdhflajkhdflkajhsdflhqwiuer);
define("ROOT",  "/" . CWD . "/public/");

/* ========================================== Back_End ============================================  */
// DB info

define("HOST", isset($db_info['HOST']) ? $db_info['HOST'] : null);
define("DB_NAME", isset($db_info['DB_NAME']) ? $db_info['DB_NAME'] : null);
define("USER", isset($db_info['USER']) ? $db_info['USER'] : null);
define("PASS", isset($db_info['PASS']) ? $db_info['PASS'] : null);

// admin Assets

define("ASSETS", ROOT . "assets/admin/");
define("APP_ASSETS", ROOT . "assets/admin/app-assets/");


/* ========================================== Front_End ============================================  */

define("FRONT_ASSETS", ROOT . 'assets/');
