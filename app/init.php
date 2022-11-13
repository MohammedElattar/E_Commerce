<?php
if (session_id() == '')
    session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once "core/config.php";
require_once("core/database.php");
require_once("core/functions.php");
require_once("core/controller.php");
require_once("core/app.php");
