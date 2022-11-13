<?php

class Login extends Controller
{
    public function index()
    {
        if (isset($_SESSION['client']['id'])) {
            header("Location:" . ROOT);
            die;
        }
        $data['title'] = "Login";
        $this->view("login", $data);
    }
    public function GoogleAuth()
    {
        $user = $this->load_model("User");
        if ($user->loggedInClient()) {
            header("Location:" . ROOT);
            die;
        }
        else {
            require_once("../app/api_client.php");
            header("Location:" . $client->createAuthUrl());
        }
    }
    public function callback()
    {
        $user = $this->load_model("User");
        if ($user->loggedInClient()) {
            header("Location:" . ROOT);
        }
        else {
            require_once("../app/api_client.php");
            if (isset($_SESSION['accessTokenClient']))
                $client->setAccessToken($_SESSION['accessTokenClient']);
            else if (isset($_GET['code'])) {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token);
                $_SESSION['accessTokenClient'] = $token;
            }
            else {
                header("Location:" . ROOT);
            }


            $obj = new Google_Service_Oauth2($client);
            $userinfo = (array)$obj->userinfo->get();
            $data = $user->loginGoogle($userinfo, true);
            if (isset($data['success'])) {
                $_SESSION['client'] = $data['data'];

            }
            header("Location:" . ROOT);
        }
    }
}