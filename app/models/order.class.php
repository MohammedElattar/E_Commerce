<?php

class Order
{
    public function make_order($POST, $products, $quantity, $price)
    {
        $id = $_SESSION['client']['id'];
        $ids = json_encode($products);
        $full_name = isset($POST['name']) ? trim(htmlspecialchars($POST['name'])) : null;
        $email = isset($POST['email']) ? trim(htmlspecialchars($POST['email'])) : null;
        $city = isset($POST['city']) ? trim(htmlspecialchars($POST['city'])) : null;
        $address = isset($POST['address']) ? trim(htmlspecialchars($POST['address'])) : null;
        $phone = isset($POST['phone']) ? filter_var($POST['phone'], FILTER_SANITIZE_NUMBER_INT) : null;
        $res = [];
        $db = DB::get_instance();
        $db->write("UPDATE users SET full_name=? , city=? , address=? , phone=?,second_email=? WHERE id=?", [$full_name, $city, $address, $phone, $email, $_SESSION['client']['id']]);
        $db->write("INSERT INTO orders (products_ids, user_id , qty, total_price) VALUES(?,?,?,?)", [$ids, $_SESSION['client']['id'], $quantity, $price]);
        $res['success'] = '1';
        return $res;
    }
    public function getContenets()
    {
        $res = [];
        if (isset($_SESSION['category']) && $_SESSION['category'][0]) {
            $db = DB::get_instance();
            $query = "SELECT orders.id as order_id, orders.qty as order_qty , orders.total_price as order_total_price , orders.status as order_status , users.full_name as client_name  FROM orders JOIN users on orders.user_id = users.id";
            $data = $db->read($query, [], true, false);
            return $data[0];
        }
        $res['not-authorized'] = '1';
        return $res;
    }
    public function makeTable($data)
    {
        $res = [];
        if (isset($_SESSION['order']) && $_SESSION['order'][0] && !isset($data['not-authorized'])) {
            $str = "";
            // print_r($data);
            foreach ($data as $i) {
                $str .= sprintf(
                    "<tr>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td class='d-flex justify-content-center align-items-center'>%s</td>
            </tr>",
                    $i['order_id'],
                    $i['client_name'],
                    $i['order_qty'],
                    $i['order_total_price'],
                    sprintf("
                    <a href='%s' class='badge rounded-pill badge-light-%s'%s data-id='%s' stats-id='%s'>%s</a>",
                    ROOT . "ajax/orders/editStatus",
                    $i['order_status'] == 0 ? 'info' : 'success',
                    'onclick="editOrderStatus(event)"',
                    $i['order_id'],
                    $i['order_status'],
                    $i['order_status'] == 0 ? 'In Progress' : "Paid"
                ),
                    sprintf(
                    "
                        <a href='%s' class='btn btn-success btn-sm edit' data-bs-toggle='modal' data-bs-target='#getOrder' onclick='getOrderInfo(event)' data-id='%s' style='margin:0 10px 0 0'>More Info</a>
                        <a href='%s' class='btn btn-danger btn-sm delete-product' onclick='deleteOrder(event)'>Delete</a>
                    ",
                    ROOT . "ajax/orders/getOrder?id=" . $i['order_id'],
                    $i['order_id'],
                    ROOT . "ajax/orders/delete?id=" . $i['order_id'],
                )
                );
            }
            return $str;
        }
        else
            $res['not-authorized'] = '1';
        return $res;
    }
    public function delete($id)
    {
        $res = [];
        if (isset($_SESSION['order']) && $_SESSION['order'][1]) {
            $db = DB::get_instance();
            $data = $db->read("SELECT id FROM orders WHERE id =? LIMIT 1", [$id], true, false);
            $id = isset($data[0][0]['id']) ? $data[0][0]['id'] : null;
            if ($id && is_numeric($id)) {
                $db->write("DELETE FROM orders WHERE id =?", [$id]);
                $res['success'] = '1';
            }
            else
                $res['not-exists'] = '1';
        }
        else
            $res['not-authoirzed'] = '1';
        return $res;
    }
    public function getOrder($id)
    {
        $res = [];
        if (isset($_SESSION['order']) && $_SESSION['order'][1] && isset($_SESSION['product']) && $_SESSION['product'][0]) {
            $db = DB::get_instance();
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            if ($id) {
                $data = $db->read(
                    "SELECT
                        users.full_name as client_name , 
                        users.email as client_email , 
                        users.city as client_city , 
                        users.address as client_address , 
                        users.phone as client_phone,
                        orders.products_ids as products
                    FROM 
                        orders
                    JOIN
                        users
                    ON
                        users.id=orders.user_id
                    WHERE orders.id=?
                    ", [$id], true, false);
                if ($data[0]) {
                    $res['success'] = '1';
                    $res['data'] = $data[0][0];
                }
            }
            else
                $res['id'] = '1';
        }
        else
            $res['not-authorized'] = 1;

        return $res;
    }

    public function edit_status($POST)
    {
        $res = [];
        if (isset($_SESSION['order']) && $_SESSION['order'][1] && isset($_SESSION['product']) && $_SESSION['product'][0]) {
            $id = isset($POST['id']) ? filter_var($POST['id'], 519) : 0;
            $status = isset($POST['status']) ? filter_var($POST['status'], 519) : -1;
            if ($status < 0 || $status > 1)
                $res['status'] = '1';
            if (!$res) {
                $db = DB::get_instance();
                $order = $db->read("SELECT id,products_ids FROM orders WHERE id =$id", [], true);
                if (!$order[1])
                    $res['order-not-exists'] = '1';
                else {
                    $products = json_decode($order[0][0]['products_ids'], true);
                    foreach ($products as $i) {
                        $prod = $db->read("SELECT id FROM products WHERE id =?", [$i['id']]);
                        if (!$prod[0]) {
                            if (!isset($res['product-not-exists']))
                                $res['product-not-exists'] = [];
                            $res['product-not-exists']['data-id'] = $i['id'];
                        }
                    }
                    $cnt = 0;
                    if (!$res) {
                        foreach ($products as $i) {
                            if ($status == 0) {
                                $prod = $db->read('SELECT quantity FROM products WHERE id =?', [$i['id']], true);
                                if ($prod[0][0]['quantity'] < $i['quantity']) {
                                    if (!isset($res['bigger-qty']))
                                        $res['bigger-qty'] = [];
                                    $res['bigger-qty']['data-id'] = $i['id'];
                                }
                            }
                        }
                        if (!$res) {
                            if ($status == 0 || $status == 1) {
                                $db->write("UPDATE orders SET status=" . ($status == 0 ? 1 : 0) . " WHERE id =$id", []);
                                foreach ($products as $i) {
                                    $db->write("UPDATE products SET quantity = quantity" . ($status == 0 ? "-" : "+") . $i['quantity'] . " WHERE id =?", [$i['id']]);
                                }
                                $res['success'] = '1';
                            }
                        }
                    }
                }
            }
        }
        else
            $res['not-authorized'] = '1';
        return $res;
    }
}