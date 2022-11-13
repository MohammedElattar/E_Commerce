<?php
class Admin extends Controller
{
    public function signup()
    {
        if ($this->logged()) {
            header("Location:" . ROOT . "admin");
        }
        else {
            $this->view("admin/signup");
        }
    }

    public function login()
    {
        if ($this->logged())
            header("Location:" . ROOT . "admin");
        else {
            $this->view('admin/login');
        }
    }
    public function authGoogle()
    {
        if ($this->logged()) {
            header("Location:" . ROOT . "admin/");
            die;
        }
        else {
            require_once("../app/api.php");
            header("Location:" . $client->createAuthUrl());
        }
    }

    public function callback()
    {
        $user = $this->load_model("User");
        if ($user->loggedIn()) {
            header("Location:" . ROOT . "admin");
        }
        else {
            require_once("../app/api.php");
            if (isset($_SESSION['accessToken']))
                $client->setAccessToken($_SESSION['accessToken']);
            else if (isset($_GET['code'])) {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token);
                $_SESSION['accessToken'] = $token;
            }
            else {
                $this->not_authorized_admin();
                die;
            }


            $obj = new Google_Service_Oauth2($client);
            $userinfo = (array)$obj->userinfo->get();
            $data = $user->loginGoogle($userinfo);
            if (isset($data['success'])) {
                $_SESSION['data'] = $data['data'];
                header("Location:" . ROOT . "admin");

            }
            else
                $this->not_authorized_admin();
        }

    }
    public function activate()
    {
        if ($this->logged())
            header("Location:" . ROOT . "admin");
        else if (isset($_SESSION['data']['verified']) && $_SESSION['data']['verified'] == 0) {
            $data['title'] = 'Email Verification';
            $this->view("admin/activate");
        }
        else
            header("Location:" . ROOT . "admin");
    }
    public function reset_password()
    {
    }
    public function logout()
    {
        require '../app/api.php';
        $client->revokeToken();
        session_unset();
        session_destroy();
        header("Location:" . ROOT . "admin/login");
    }
    public function not_found()
    {
        if ($this->logged()) {
            $data['title'] = "404";
            $this->view("admin/404");
        }
        else
            $this->not_authorized_admin();

    }
    public function not_authorized()
    {
        if ($this->logged()) {
            header("Location:" . ROOT . "admin");
            die;
        }
        else {
            $data['title'] = "Permissions";
            $this->view("admin/not_authorized");
        }
    }
    public function pending()
    {
        if ($this->logged()) {
            header("Location:" . ROOT . "admin");
            die;
        }
        else if (isset($_SESSION['data']) && $_SESSION['data']['status'] == 1) {
            $data['title'] = "Pending";
            $this->view("admin/pending", $data);
        }
        else
            header("Location:" . ROOT . "admin/login");
    }
    public function rejected()
    {
        if ($this->logged()) {
            header("Location:" . ROOT . "admin");
            die;
        }
        else if (isset($_SESSION['data']) && $_SESSION['data']['status'] == 0) {
            $data['title'] = "Suspensed";
            $this->view("admin/rejected", $data);
        }
        else
            header("Location:" . ROOT . "admin/login");
    }
    public function profile($param)
    {
        $param = json_decode($param, true);
        $user = $this->load_model("User");
        $user->authorized();
        if ($user->loggedIn()) {
            if ($param == 'home' || $param == 'account') {
                $data['title'] = 'Profile';
                $this->view("admin/profile", $data);
            }
            else if (isset($param[2]) && $param[2] == 'security') {
                $data['title'] = 'Secutiry';
                $this->view("admin/security", $data);
            }
            else
                header("Location:" . ROOT . "admin/not_found");
        }
        else
            $this->not_authorized_admin();
    }
    public function index()
    {
        $user = $this->load_model("User");
        $user->authorized();
        if ($user->loggedIn()) {
            $data['title'] = 'Dashboard';
            $this->view("admin/dashboard", $data);
        }
        else
            $this->not_authorized_admin();

    }
    public function dashboard()
    {
        $user = $this->load_model("User");
        $user->authorized();
        if ($user->loggedIn()) {
            $data['title'] = 'Dashboard';
            $this->view("admin/dashboard", $data);
        }
        else
            $this->not_authorized_admin();
    }




    public function users()
    {
        $user = $this->load_model("User");
        $user->authorized();
        if ($user->loggedIn() && isset($_SESSION['user']) && $_SESSION['user'][0]) {
            $data['title'] = 'Manage Users';
            $this->view("admin/users", $data);
        }
        else
            $this->not_authorized_admin();
    }
    public function categories($param)
    {
        $param = trim($param);
        $user = $this->load_model("User");
        $user->authorized();
        if ($user->loggedIn() && isset($_SESSION['category']) && $_SESSION['category'][0]) {
            $data['title'] = 'Manage Categories';
            $this->view("admin/categories", $data);
        }
        else
            $this->not_authorized_admin();
    }
    public function products($param)
    {
        $param = trim($param);
        $user = $this->load_model("User");
        $user->authorized();
        if ($user->loggedIn() && isset($_SESSION['product']) && $_SESSION['product'][0]) {
            $data['title'] = 'Manage Products';
            $this->view("admin/products", $data);
        }
        else
            $this->not_authorized_admin();
    }
    public function orders($param)
    {
        $param = trim($param);
        $user = $this->load_model("User");
        $user->authorized();
        if ($user->loggedIn() && isset($_SESSION['order']) && $_SESSION['order'][0]) {
            $data['title'] = 'Manage Orders';
            $this->view("admin/orders", $data);
        }
        else
            $this->not_authorized_admin();
    }
    public function roles($param)
    {
        $param = trim($param);
        $user = $this->load_model("User");
        $user->authorized();
        if ($user->loggedIn() && isset($_SESSION['role']) && $_SESSION['role'][0]) {
            $data['title'] = 'Manage Roles';
            $this->view("admin/roles", $data);
        }
        else
            $this->not_authorized_admin();
    }
}