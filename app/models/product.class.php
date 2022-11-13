<?php

class Product
{

    public function add($POST, $FILES)
    {
        /**
         * Add new category
         * 
         * This function used to add new Category
         * 
         * @param array $POST Form Data
         * 
         * @param array $_FILES photos 
         * 
         * @return array $res results
         */

        $res = [];
        if (isset($_SESSION['product']) && $_SESSION['product'][2]) {
            $name = htmlspecialchars(trim($POST['name']));
            $cat = isset($POST['cat_id']) ? filter_var($POST['cat_id'], FILTER_SANITIZE_NUMBER_INT) : 0;
            $description = trim(htmlspecialchars($POST['description']));
            $quantity = filter_var($POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
            $price = filter_var($POST['price'], FILTER_SANITIZE_NUMBER_FLOAT);
            $discount = filter_var($POST['discount'], FILTER_SANITIZE_NUMBER_FLOAT);
            $files = array_keys($FILES);
            $cnt = count($files);
            if (!$name || !is_string($name))
                $res['name'] = '1';
            if (!is_numeric($cat) || !$cat)
                $res['category'] = '1';
            if (!$description)
                $res['description'] = '1';
            if (!is_numeric($quantity) || $quantity <= 0)
                $res['quantity'] = '1';
            if (!is_numeric($price) || $price <= 0)
                $res['price'] = '1';
            if (!is_numeric($discount) || (is_numeric($discount) && ($discount < 0 || $discount > 100)))
                $res['discount'] = '1';
            if (!$cnt)
                $res['photos'] = '1';
            for ($i = 0; $i < $cnt && $i < 4; $i++) {
                $img = $FILES[$files[$i]];
                if (explode('/', $img['type'])[0] != 'image')
                    $res["photo_$i"] = 'not-valid';
                if ($img['size'] > 4000000)
                    $res["photo_$i"] = 'large';
            }
            if (!$res) {
                $db = db::get_instance();
                $found = $db->read("SELECT id FROM categories WHERE id=? AND status = 1", [$cat]);
                if (!$found[0])
                    $res['cat-not-exists'] = '1';
                else {
                    $found = $db->read("SELECT name,quantity FROM products WHERE name =?", [$name], true);
                    if ($found[1]) {
                        $res['prod-exists'] = '1';
                    }
                    else {
                        $images = [];
                        if (!file_exists("../public/uploads/products")) {
                            mkdir("../public/uploads/products", 0777, true);
                        }
                        for ($i = 0; $i < $cnt && $i < 4; $i++) {
                            $photo_name = rand(1e6, 2e6) . "_" . rand(1e6, 2e6) . "." . explode('/', $FILES[$files[$i]]['type'])[1];
                            move_uploaded_file($FILES[$files[$i]]['tmp_name'], "../public/uploads/products/$photo_name");
                            array_push($images, $photo_name);
                        }
                        $status = $discount ? 2 : 0;
                        $db->write("INSERT INTO products (name , quantity , price , discount , description ,images , category_id ,status) VALUES(?,?,?,?,?,?,?,?)", [$name, $quantity, $price, $discount, $description, json_encode($images), $cat, $status]);
                        $res['success'] = '1';
                    }
                }
            }
        }
        else
            $res['not-authorized'] = '1';
        return $res;
    }
    public function edit($POST, $FILES)
    {
        /**
         * Add new category
         * 
         * This function used to add new Category
         * 
         * @param array $POST Form Data
         * 
         * @param array $_FILES photos 
         * 
         * @return array $res results
         */

        $res = [];
        if (isset($_SESSION['product']) && $_SESSION['product'][1]) {
            $name = htmlspecialchars(trim($POST['name']));
            $cat = isset($POST['cat_id']) ? filter_var($POST['cat_id'], FILTER_SANITIZE_NUMBER_INT) : 0;
            $description = trim(htmlspecialchars($POST['description']));
            $quantity = trim($POST['quantity']);
            $price = trim($POST['price']);
            $discount = trim($POST['discount']);
            $files = array_keys($FILES);
            $cnt = count($files);
            $id = filter_var($POST['id'], FILTER_SANITIZE_NUMBER_INT) or 0;
            if (!$name || !is_string($name))
                $res['name'] = '1';
            if (!is_numeric($cat) || !$cat)
                $res['category'] = '1';
            if (!$description)
                $res['description'] = '1';
            if (!is_numeric($quantity) || $quantity <= 0)
                $res['quantity'] = '1';
            if (!is_numeric($price) || $price <= 0)
                $res['price'] = '1';
            if (!is_numeric($discount) || (is_numeric($discount) && ($discount < 0 || $discount > 100)))
                $res['discount'] = '1';
            for ($i = 0; $i < $cnt && $i < 4; $i++) {
                $img = $FILES[$files[$i]];
                if (explode('/', $img['type'])[0] != 'image')
                    $res["photo_$i"] = 'not-valid';
                if ($img['size'] > 4000000)
                    $res["photo_$i"] = 'large';
            }
            if (!$res) {
                $db = db::get_instance();
                $found = $db->read("SELECT id FROM categories WHERE id=? AND status = 1", [$cat]);
                if (!$found[0])
                    $res['cat-not-exists'] = '1';
                else {
                    $prod_info = $db->read("SELECT name , quantity FROM products WHERE name=? AND id !=?", [$name, $id], true);
                    if ($prod_info[1]) {
                        $res['prod-exists'] = '1';
                    }
                    else {
                        $prod = $db->read("SELECT id , date, images,status FROM products WHERE id =?", [$id], true, false)[0][0];
                        if (isset($prod['id'])) {
                            $old_images = json_decode($prod['images']);
                            if (!file_exists("../public/uploads/products")) {
                                mkdir("../public/uploads/products", 0777, true);
                            }
                            for ($i = 0; $i < $cnt && $i < 4; $i++) {
                                $photo_name = rand(1e6, 2e6) . "_" . rand(1e6, 2e6) . "." . explode('/', $FILES[$files[$i]]['type'])[1];
                                move_uploaded_file($FILES[$files[$i]]['tmp_name'], "../public/uploads/products/$photo_name");
                                if (file_exists("../public/uploads/products/" . $old_images[$i])) {
                                    unlink("../public/uploads/products/$old_images[$i]");
                                }
                                $old_images[$i] = $photo_name;
                            }
                            $status = $discount ? 2 : (date("Y-m-d H:i:s", strtotime("-2 days")) > date('Y-m-d H:i:s') ? 1 : 0);
                            $db->write("UPDATE products SET name = ? , quantity = ? ,description=?, price = ? , discount = ? , images = ? , category_id = ? , status=?  WHERE id=?", [$name, $quantity, $description, $price, $discount, json_encode($old_images), $cat, $status, $id]);
                            $res['success'] = '1';
                        }
                        else
                            $res['prod-not-exists'] = '1';
                    }
                }
            }
        }
        else
            $res['not-authorized'] = '1';
        return $res;
    }
    public function getContenets()
    {
        $db = DB::get_instance();
        $query = "SELECT products.* , categories.cat_name as cat_name  FROM products JOIN categories ON categories.id = products.category_id WHERE categories.status=1";
        $data = $db->read($query, [], true, false);
        return $data[0];
    }
    public function makeTable($data)
    {
        $res = [];
        if (isset($_SESSION['product']) && $_SESSION['product'][0]) {
            $str = "";
            // print_r($data);
            foreach ($data as $i) {
                $images = json_decode($i['images']);
                $images = isset($images[0]) ? $images[0] : '';
                $str .= sprintf("<tr>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td style='display:inline-flex;justify-content:space-between;'>%s</td>
            </tr>", $i['id'], $i['name'], $i['quantity'], $i['price'],
                    sprintf(
                    "<img src='%s' style='width:74px;height:50px;'>",
                    ROOT . "uploads/products/" . $images),
                    $i['cat_name'],
                    sprintf
                    (
                    "<a class='badge rounded-pill badge-light-%s' data-id='%s'>%s</a>",
                    ($i['status'] == 2 || (int)$i['discount']) ? "success" : (($i['status'] == 1 || Date("Y-m-d H:i:s", strtotime("-2 days")) > $i['date']) ? 'primary' : 'danger'),
                    $i['id'],
                    ($i['status'] == 2 || (int)$i['discount']) ? 'Sale' : (($i['status'] == 1 || Date("Y-m-d H:i:s", strtotime("-2 days")) > $i['date']) ? 'Normal' : 'New')),
                    sprintf
                    (
                    "
                    <a href='%s' class='btn btn-success btn-sm edit' %s data-id='%s'>Edit</a>
                    <a href='%s' class='btn btn-danger btn-sm delete-product' %s>Delete</a>
                ",
                    ROOT . "ajax/products/editItem?id=" . $i['id'],
                    isset($_SESSION['product']) && $_SESSION['product'][1] ? "data-bs-toggle='modal' data-bs-target='#editProduct' onclick='editProduct(event)'" : "onclick='return false'",
                    $i['id'],
                    ROOT . "ajax/products/delete?id=" . $i['id'],
                    isset($_SESSION['product']) && $_SESSION['product'][1] ? "onclick='deleteProduct(event)'" : "onclick='return false'",

                ));
            }
            return $str;
        }
        $res['not-authorized'] = '1';
        return json_encode($res);
    }
    public function delete($id)
    {
        $res = [];
        if (isset($_SESSION['product']) && $_SESSION['product'][1]) {
            $db = DB::get_instance();
            $data = $db->read("SELECT id FROM products WHERE id =? LIMIT 1", [$id], true, false);
            $id = isset($data[0][0]['id']) ? $data[0][0]['id'] : null;
            if ($id && is_numeric($id)) {
                $data = json_decode($db->read("SELECT images FROM products WHERE id =?", [$id], true, false)[0][0]['images'], true);
                foreach ($data as $i) {
                    if (file_exists("../public/uploads/products/$i"))
                        unlink("../public/uploads/products/$i");
                }
                $db->write("DELETE FROM products WHERE id =?", [$id]);
                $res['success'] = '1';
            }
            else
                $res['not-exists'] = '1';
        }
        else
            $res['not-authoirzed'] = '1';
        return $res;
    }
    public function get_categories()
    {
        $res = [];
        if (isset($_SESSION['category']) && $_SESSION['category'][0]) {

            $db = DB::get_instance();
            return $db->read("SELECT id , cat_name FROM categories WHERE status = 1", [], true, false);
        }
        else
            $res['not-authorized'] = '1';
        return $res;
    }

    public function getItem($id)
    {
        $res = [];
        if (isset($_SESSION['product']) && $_SESSION['product'][0]) {
            $db = DB::get_instance();
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            if ($id) {
                $data = $db->read("SELECT products.* , categories.cat_name as cat_name FROM products JOIN categories ON categories.id=products.category_id WHERE products.id =? AND categories.status=1", [$id], true, false);
                if ($data[0]) {
                    $res['success'] = '1';
                    $res['data'] = $data[0][0];
                }
            }
            else
                $res['id'] = '1';
        }
        else
            $res['not-authoirzed'] = '1';
        return $res;
    }
    public function home_products($query, $execute = [])
    {
        $db = DB::get_instance();
        return $db->read($query, $execute, true)[0];
    }
    public function get_product_details($id)
    {
        $res = [];
        $db = DB::get_instance();
        $data = $db->read("SELECT products.id , name , price , discount , quantity ,description, images , categories.cat_name as cat_name FROM products JOIN categories ON categories.id=products.category_id WHERE products.id =? AND quantity > 0 AND categories.status=1", [$id], true);
        if ($data[1]) {
            $res['data'] = $data[0][0];
        }
        else
            $res['not-exists'] = '1';
        return $res;
    }
}