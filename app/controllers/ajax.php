<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../app/controllers/apis/PHPMailer/vendor/autoload.php';
// print_r(get_included_files());

class Ajax extends Controller
{ /* ================================================ Admin ============================================ */
    public function index()
    {
        $this->not_authorized_admin();
    }
    /** ============================================================= User =============================================================== */
    public function Login()
    {
        if ($this->isPost()) {
            $_POST = json_decode(file_get_contents('php://input'), true);
            $user = $this->load_model("User");
            $res = $user->login($_POST);
            if (isset($res['verify']))
                $res['verify'] = ROOT . "admin/activate";
            $res = json_encode($res);
            echo $res;
        } else
            $this->not_authorized_admin();
    }

    public function register()
    {
        if ($this->isPost()) {
            $_POST = json_decode(file_get_contents('php://input'), true);
            $user = $this->load_model("User");
            $res = $user->register($_POST);
            if (isset($res['success'])) {
                $db = DB::get_instance();
                // $res = $db->read("SELECT")
                define("VERIFY_CODE", rand(1e6, 2e6));
                $verify_code = VERIFY_CODE;
                if ($this->phpmailer(
                    trim($_POST['email']),
                    "Email Verification From Moahemd Attar",
                    sprintf(
                        "Hi {$_POST['first-name']} , thank You for register at Theme Store ,\nYour Verification Code is <b style='color:red;'>$verify_code</b>"
                    ),
                )) {
                    $res['sent'] = '1';
                } else
                    $res['not-sent'] = '1';
                if (isset($res['sent'])) {
                    $db->write(
                        "UPDATE users SET expires=? , 
                        code=? WHERE email=?",
                        [
                            Date(
                                "Y-m-d H:i:s",
                                strtotime("+3600 seconds")
                            ),
                            $verify_code, trim($_POST['email'])
                        ]
                    );
                }
            }
            $res = json_encode($res);
            echo $res;
        } else
            $this->not_authorized_admin();
    }
    function __construct()
    {
    }

    private function phpmailer($recepient, $subject, $body)
    {
        if ($this->isPost()) {
            $mail = new PHPMailer(true);
            try {
                // SMPT Settings settings
                // $mail->SMTPDebug = 4;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com;smtp.office365.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'mohammedattar0100020@gmail.com';
                $mail->Password = 'dbltasalunjrdnbl';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->SMTPOptions = [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ]
                ];
                //Recipients
                $mail->setFrom('mohammedattar0100020@gmail.com', 'Mohamed Attar');
                $mail->addAddress($recepient, 'Reciepent');
                // attachments
                $mail->addAttachment('../app/controllers/apis/PHPMailer/inc/photo.jpg', 'new.jpg'); //Optional name

                //Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $body;

                $mail->send();
                return true;
            } catch (Exception $e) {
                return false;
            }
        } else
            $this->not_authorized_admin();
    }

    public function resend_verify()
    {
        if (isset($_SESSION['data']) && $_SESSION['data']['verified'] == 0) {
            if ($this->isPost()) {
                $db = DB::get_instance();
                $res = [];
                define("VERIFY_CODE", rand(1e6, 2e6));
                $verify_code = VERIFY_CODE;
                if ($this->phpmailer(
                    trim($_SESSION['data']['email']),
                    "Email Verification From Moahemd Attar",
                    "You Have Requested A New Code For Theme Store , Your New Code Is  $verify_code",
                )) {
                    $res['sent'] = '1';
                } else
                    $res['not-sent'] = '1';
                if (isset($res['sent'])) {
                    $db->write(
                        "UPDATE users SET expires=? , 
                                code=? WHERE email=?",
                        [
                            Date(
                                "Y-m-d H:i:s",
                                strtotime("+3600 seconds")
                            ),
                            $verify_code, trim($_SESSION['data']['email'])
                        ]
                    );
                }
                $res = json_encode($res);
                echo $res;
            } else
                $this->not_authorized_admin();
        } else
            header("Location:" . ROOT . "login");
    }
    public function verify()
    {
        if ($this->isPost()) {
            $_POST = json_decode(file_get_contents('php://input'), true);
            $user = $this->load_model("User");
            $res = $user->verify($_POST);
            if (isset($res['success']))
                $_SESSION['data']['verified'] = '1';
            echo json_encode($res);
        } else
            $this->not_authorized_admin();
    }

    public function profile($param)
    {
        $param = json_decode($param, true);
        if (isset($_SESSION['data']['id']) && $_SESSION['data']['verified']) {
            $user = $this->load_model("user");
            if ($this->isPost()) {
                if (isset($param[2]) && $param[2] == 'edit') {
                    echo json_encode($user->edit($_POST, $_FILES));
                } else if (isset($param[2]) && $param[2] == 'edit_password') {
                    $_POST = json_decode(file_get_contents("php://input"), true);
                    echo json_encode($user->edit_password($_POST));
                } else if (isset($param[2]) && $param[2] == 'delete') {
                    echo json_encode($user->delete($_SESSION['data']['id']));
                } else
                    header("Location:" . ROOT . "admin/not_found");
            } else
                $this->not_authorized_admin();
        } else
            $this->not_authorized_admin();
    }

    public function users($param)
    {
        $param = json_decode($param, true);
        if (isset($_SESSION['data']['id']) && $_SESSION['data']['status'] == '2') {
            if ($this->isPost()) {
                $_POST = json_decode(file_get_contents('php://input'), true);
                $user = $this->load_model("User");
                if (isset($param[2]) && $param[2] == 'getRoles') {
                    echo json_encode($user->get_roles());
                } else if (isset($param[2]) && $param[2] == 'getItem') {
                    echo json_encode($user->get_user($_POST['id']));
                } else if (isset($param[2]) && $param[2] == 'getUsers') {
                    print_r($user->get_users());
                } else if (isset($param[2]) && $param[2] == 'add') {
                    $res = json_encode($user->add_admin($_POST));
                    echo $res;
                } else if (isset($param[2]) && $param[2] == 'edit') {
                    echo json_encode($user->edit_admin($_POST));
                } else if (isset($param[2]) && $param[2] == 'approve') {
                    echo json_encode($user->approve_admin($_POST['id']));
                } else if (isset($param[2]) && $param[2] == 'editStatus') {
                    echo (json_encode($user->edit_status_admin($_POST['id'], $_POST['status'])));
                } else if (isset($param[2]) && $param[2] == 'delete') {
                    $id = isset($_POST['id']) ? $_POST['id'] : "0";
                    echo json_encode($user->delete_admin($id));
                }
            } else
                $this->not_authorized_admin();
        } else
            $this->not_authorized_admin();
    }
    /* ===================================================== Categories ==========================================================*/
    public function categories($param)
    {
        $param = json_decode($param, true);
        if ($this->logged()) {
            if ($this->isPost()) {
                $_POST = json_decode(file_get_contents('php://input'), true);
                $category = $this->load_model("Category");
                if (isset($param[2]) && $param[2] == 'getContents') {
                    echo $category->makeTable($category->getContenets());
                } else if (isset($param[2]) && $param[2] == 'getItem') {
                    print_r($category->getContenets("SELECT cat_name FROM categories WHERE id =?", [$_POST])[0]['cat_name']);
                } else if (isset($param[2]) && $param[2] == 'add') {
                    $res = json_encode($category->add($_POST));
                    echo $res;
                } else if (isset($param[2]) && $param[2] == 'edit') {
                    echo json_encode($category->edit($_POST));
                } else if (isset($param[2]) && $param[2] == 'editStatus') {
                    $res = json_encode($category->editStatus($_POST['id']));
                    echo $res;
                } else if (isset($param[2]) && $param[2] == 'delete') {
                    $id = isset($param[3]) ? filter_var(trim(htmlspecialchars(explode('=', $param[3])[1])), FILTER_SANITIZE_NUMBER_INT) : 0;
                    echo json_encode($category->delete($id));
                }
            } else
                $this->not_authorized_admin();
        } else
            $this->not_authorized_admin();
    }
    /* ===================================================== Products ================================================================*/

    public function products($param)
    {
        $param = json_decode($param, true);
        if ($this->logged()) {
            if ($this->isPost()) {
                $product = $this->load_model("Product");
                if (isset($param[2]) && $param[2] == 'getContents') {
                    echo $product->makeTable($product->getContenets());
                } else if (isset($param[2]) && $param[2] == 'getCategories') {
                    echo json_encode($product->get_categories($_POST)[0]);
                } else if (isset($param[2]) && $param[2] == 'getItem') {
                    $id = json_decode(file_get_contents('php://input'), true)['id'];
                    echo json_encode($product->getItem($id));
                } else if (isset($param[2]) && $param[2] == 'add') {
                    echo json_encode($product->add($_POST, $_FILES));
                } else if (isset($param[2]) && $param[2] == 'edit') {
                    echo json_encode($product->edit($_POST, $_FILES));
                } else if (isset($param[2]) && $param[2] == 'delete') {
                    $id = isset($param[3]) ? filter_var(trim(htmlspecialchars(explode('=', $param[3])[1])), FILTER_SANITIZE_NUMBER_INT) : 0;
                    echo json_encode($product->delete($id));
                }
            } else
                $this->not_authorized_admin();
        } else
            $this->not_authorized_admin();
    }
    public function orders($param)
    {
        $param = json_decode($param, true);
        if ($this->logged()) {
            if ($this->isPost()) {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $order = $this->load_model("Order");
                if (isset($param[2]) && $param[2] == 'getContents') {
                    echo $order->makeTable($order->getContenets());
                } else if (isset($param[2]) && $param[2] == 'getProducts') {
                    echo json_encode($order->get_products($_POST));
                } else if (isset($param[2]) && $param[2] == 'getOrder') {
                    $id = json_decode(file_get_contents('php://input'), true)['id'];
                    echo json_encode($order->getOrder($id));
                } else if (isset($param[2]) && $param[2] == 'editStatus') {
                    echo json_encode($order->edit_status($_POST));
                } else if (isset($param[2]) && $param[2] == 'add') {
                    echo json_encode($order->add($_POST, $_FILES));
                } else if (isset($param[2]) && $param[2] == 'edit') {
                    echo json_encode($order->edit($_POST, $_FILES));
                } else if (isset($param[2]) && $param[2] == 'delete') {
                    $id = isset($param[3]) ? trim(htmlspecialchars(explode('=', $param[3])[1])) : 'id';
                    echo json_encode($order->delete($id));
                }
            } else
                $this->not_authorized_admin();
        } else
            $this->not_authorized_admin();
    }
    public function roles($param)
    {
        $param = json_decode($param, true);
        if ($this->logged()) {
            if ($this->isPost()) {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $role = $this->load_model("Role");
                if (isset($param[2]) && $param[2] == 'getContents') {
                    echo $role->makeTable($role->getContenets());
                } else if (isset($param[2]) && $param[2] == 'getRoles') {
                    echo json_encode($role->get_roles($_POST));
                } else if (isset($param[2]) && $param[2] == 'getItem') {
                    echo json_encode($role->get_item($_POST['id']));
                } else if (isset($param[2]) && $param[2] == 'getUsers') {
                    echo json_encode($role->makeTable($role->get_users()));
                } else if (isset($param[2]) && $param[2] == 'add') {
                    echo json_encode($role->add($_POST));
                } else if (isset($param[2]) && $param[2] == 'edit') {
                    echo json_encode($role->edit($_POST));
                } else if (isset($param[2]) && $param[2] == 'delete') {
                    echo json_encode($role->delete($_POST['id']));
                }
            } else
                $this->not_authorized_admin();
        } else
            $this->not_authorized_admin();

        /* ========================================= Public User ===================================== */
    }
    public function tmpCart($param)
    {
        if ($this->isPost()) {
            $_POST = json_decode(file_get_contents("php://input"), true);
            if (!isset($_SESSION['tmp_cart']))
                $_SESSION['tmp_cart'] = [];
            $param = json_decode($param, true);
            $param = isset($param[2]) ? $param[2] : "";
            $cart = $this->load_model("Cart");
            if ($param == 'addItem') {
                $data = $cart->add(isset($_POST['id']) ? $_POST['id'] : '');
                if (isset($data['success'])) {
                    if (isset($_SESSION['tmp_cart']['id_' . $data['data']['id']])) {
                        if ($_SESSION['tmp_cart']['id_' . $data['data']['id']]['quantity'] < $data['data']['quantity']) {
                            $_SESSION['tmp_cart']['id_' . $data['data']['id']]['quantity']++;
                            $_SESSION['tmp_cart']['id_' . $data['data']['id']]['price'] = $data['data']['price'] - (($data['data']['discount'] * $data['data']['price']) / 100);
                            $_SESSION['tmp_cart']['id_' . $data['data']['id']]['total_qty'] = $data['data']['quantity'];
                        } else {
                            $data['bigger-qty'] = '1';
                            unset($data['success']);
                        }
                    } else {
                        $_SESSION['tmp_cart']['id_' . $data['data']['id']]['quantity'] = 1;
                        $_SESSION['tmp_cart']['id_' . $data['data']['id']]['id'] = $data['data']['id'];
                        $_SESSION['tmp_cart']['id_' . $data['data']['id']]['name'] = $data['data']['name'];
                        $_SESSION['tmp_cart']['id_' . $data['data']['id']]['price'] = $data['data']['price'] - (($data['data']['discount'] * $data['data']['price']) / 100);
                        $_SESSION['tmp_cart']['id_' . $data['data']['id']]['total_qty'] = $data['data']['quantity'];
                        $_SESSION['tmp_cart']['id_' . $data['data']['id']]['image'] = json_decode($data['data']['images'], true)[0];
                    }
                }
                echo json_encode($data);
            } else if ($param == 'delete') {
                if (isset($_POST['id'])) {
                    echo json_encode($cart->remove($_POST['id']));
                }
            } else if ($param == 'update') {
                echo json_encode($cart->update($_POST));
            }
        } else
            header("Location:" . ROOT);
    }

    public function clientLogin()
    {
        if ($this->isPost()) {
            $_POST = json_decode(file_get_contents("php://input"), true);
            $user = $this->load_model("User");
            echo json_encode($user->login_client($_POST));
        } else
            header("Location:" . ROOT);
    }

    public function clientRegister()
    {
        if ($this->isPost()) {
            $_POST = json_decode(file_get_contents("php://input"), true);
            $user = $this->load_model("User");
            echo json_encode($user->register_client($_POST));
        } else
            header("Location:" . ROOT);
    }

    public function checkout($param)
    {
        if ($this->isPost()) {
            $param = json_decode($param, true);
            $param = isset($param[2]) ? htmlspecialchars($param[2]) : null;
            $_POST = json_decode(file_get_contents("php://input"), true);
            $product = $this->load_model("Product");
            $ids = "";
            if ($param == 'add') {
                $cart = $_SESSION['tmp_cart'];
                foreach ($cart as $i) {
                    if (isset($i['id']))
                        $ids .= "{$i['id']},";
                }
                $ids .= '0';
                $products = $product->home_products("SELECT id,name, quantity , price,discount FROM products WHERE id IN (" . $ids . ")");
                $res = [];
                $total_qty = 0;
                $total_price = 0;
                $products_info = [];
                foreach ($products as $i) {
                    $_SESSION['tmp_cart']['id_' . $i['id']]['price'] = ($i['price'] - (($i['discount'] * $i['price']) / 100));
                    $_SESSION['tmp_cart']['id_' . $i['id']]['total_qty'] = $i['quantity'];
                    if ($_SESSION['tmp_cart']['id_' . $i['id']]['quantity'] > $i['quantity']) {
                        if (!isset($res['bigger-qty']))
                            $res['bigger-qty'] = [];
                        $res['bigger-qty']['data-id'] = $i['id'];
                    }
                    $products_info[$i['id']] = ["id" => $_SESSION['tmp_cart']['id_' . $i['id']]['id'], 'quantity' => $_SESSION['tmp_cart']['id_' . $i['id']]['quantity'], 'price' => $_SESSION['tmp_cart']['id_' . $i['id']]['price'], 'name' => $_SESSION['tmp_cart']['id_' . $i['id']]['name']];
                    $total_qty += $_SESSION['tmp_cart']['id_' . $i['id']]['quantity'];
                    $total_price += $_SESSION['tmp_cart']['id_' . $i['id']]['price'];
                }
                if (!$res) {
                    $order = $this->load_model("Order");
                    $data = $order->make_order($_POST, $products_info, $total_qty, $total_price);
                    if (isset($data['success']))
                        $res['success'] = '1';
                }
            }
            $_SESSION['checkout-result'] = $res;
            echo json_encode($res);
        } else
            header("Location:" . ROOT);
    }
}
