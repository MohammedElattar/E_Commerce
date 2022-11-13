<?php

class Logout
{
    public function index()
    {
        require '../app/api_client.php';
        $client->revokeToken();
        if (isset($_SESSION['client']))
            unset($_SESSION['client']);
        if (isset($_SESSION['accessTokenClient']))
            unset($_SESSION['accessTokenClient']);
        header("Location:" . ROOT);
    }
}