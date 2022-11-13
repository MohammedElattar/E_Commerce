<?php
class Cart
{
    public function add($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $res = [];
        if (!$id)
            $res['id'] = '1';
        else {
            $db = DB::get_instance();
            $prod = $db->read("SELECT id ,name ,  quantity , price, discount,images FROM products WHERE id =?", [$id], true)[0];
            if (isset($prod[0]['id'])) {
                $res['success'] = '1';
                $res['data'] = $prod[0];
            }
            else
                $res['prod-not-exists'] = '1';
        }
        return $res;
    }
    public function remove($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $res = [];
        if (isset($_SESSION['tmp_cart']['id_' . $id])) {
            $res['success'] = '1';
            unset($_SESSION['tmp_cart']['id_' . $id]);
        }
        else
            $res['not-exists'] = '1';
        return $res;
    }
    public function update($POST)
    {
        $res = [];
        $j = 0;
        if (isset($_SESSION['tmp_cart'])) {
            foreach ($POST as $i) {
                $i = json_decode($i, true);
                if (isset($_SESSION['tmp_cart']['id_' . $i['id']])) {
                    $qty = trim(htmlspecialchars($i['qty']));
                    $qty = (int)$qty;
                    if (is_integer($qty)) {
                        $qty = (int)$qty;
                        if ($qty > 0 && $qty <= $_SESSION['tmp_cart']['id_' . $i['id']]['total_qty']) {
                            $_SESSION['tmp_cart']['id_' . $i['id']]['quantity'] = $qty;
                            $j++;
                        }
                        else {
                            if ($qty <= 0) {
                                if (!isset($res['qty-zero']))
                                    $res['qty-zero'] = [];
                                $res['qty-zero']['data-id'] = $i['id'];
                            }
                            else {
                                if (!isset($res['qty-bigger']))
                                    $res['qty-bigger'] = [];
                                $res['qty-bigger']['data-id'] = $i['id'];
                            }
                        }
                    }
                }
                else {
                    if (!isset($res['quantity-not-int']))
                        $res['quantity-not-int'] = [];
                    $res['quantity-not-int']['data-id'] = $i['id'];
                }
            }
        }
        else
            $res['cart-not-exists'] = '1';
        if ($j == count($POST))
            $res['success'] = '1';
        return $res;
    }
}