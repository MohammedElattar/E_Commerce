<?php
if (session_id() == '')
    session_start();
require_once 'controllers/apis/google/vendor/autoload.php';
$client_id = "154048805002-4a1mguddb13funrmkv00f7h4k0cv0hf9.apps.googleusercontent.com";
$client_secret = "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";
$redirect_url = "http://localhost/E_Commerce_2/public/login/callback";
$client = new Google_Client();
$client->setAuthConfig("../app/client_info.json");
$client->setRedirectUri($redirect_url);
$client->setClientSecret("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");
$client->setAccessType('offline');
$client->addScope("profile");
$client->addScope("email");