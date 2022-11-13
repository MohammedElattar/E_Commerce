<?php
class Checkout extends Controller
{
    public function index()
    {
        $user = $this->load_model("User");
        if ($user->loggedInClient() && isset($_SESSION['tmp_cart']) && $_SESSION['tmp_cart']) {
            $data['title'] = 'Checkout';
            $this->view("checkout");
        }
        else
            header("Location:" . ROOT . "login");
    }
    public function summary()
    {
        if (isset($_SESSION['client']['id']) && isset($_SESSION['checkout-result'])) {
            $data['title'] = "Order Summary";
            $this->view("summary", $data);
        }
        else
            header("Location:" . ROOT);
    }
}