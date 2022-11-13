<?php

class Category
{

    public function add($POST)
    {
        /**
         * Add new category
         * 
         * This function used to add new Category
         * 
         * @param array $POST Form Data
         * 
         * @return array $res results
         */

        $res = [];
        if (isset($_SESSION['category']) && $_SESSION['category'][2]) {
            $name = htmlspecialchars(trim($POST['name']));
            if (!ctype_alpha($name))
                $res['name'] = '1';
            $db = db::get_instance();
            if (!$res) {
                $found = $db->read("SELECT cat_name FROM categories WHERE cat_name=?", [$name]);
                if ($found[0])
                    $res['exists'] = '1';
                else {
                    $db->write("INSERT INTO categories (cat_name) VALUES(?)", [$name]);
                    $res['success'] = '1';
                }
            }
        }
        else
            $res['not-authorized'] = '1';
        return $res;
    }
    public function edit($POST)
    {
        /**
         * Add new category
         * 
         * This function used to add new Category
         * 
         * @param array $POST Form Data
         * 
         * @return array $res results
         */

        $res = [];
        $id = isset($POST['id']) ? filter_var($POST['id'], FILTER_SANITIZE_NUMBER_INT) : 0;
        if (isset($_SESSION['category']) && $_SESSION['category'][1]) {
            $name = htmlspecialchars(trim($POST['name']));
            if (!ctype_alpha($name))
                $res['name'] = '1';
            $db = db::get_instance();
            if (!$res) {
                $found = $db->read("SELECT cat_name FROM categories WHERE cat_name=? AND id!=?", [$name, $id]);
                if ($found[0])
                    $res['exists'] = '1';
                else {
                    $db->write("UPDATE categories SET cat_name=? WHERE id =?", [$name, $id]);
                    $res['success'] = '1';
                }
            }
        }
        else
            $res['not-authorized'] = '1';

        return $res;
    }
    public function getContenets($query = "SELECT * FROM categories", $execute = [])
    {
        $res = [];
        if (isset($_SESSION['category']) && $_SESSION['category'][0]) {

            $db = DB::get_instance();
            $data = $db->read($query, $execute, true, false);
            return $data[0];
        }
        $res['not-authorized'] = '1';
        return $res;
    }
    public function makeTable($data)
    {
        $res = [];
        if (isset($_SESSION['category']) && $_SESSION['category'][0] && !isset($data['not-authorized'])) {
            $str = "";
            foreach ($data as $i) {
                $str .= sprintf("<tr>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
            </tr>", $i['id'], $i['cat_name'], sprintf("<a href='%s' class='badge rounded-pill badge-light-%s' data-id='%s' onclick='editCategoryStatus(event)'>%s</a>", ROOT . 'ajax/categories/editStatus', $i['status'] ? 'success' : 'danger', $i['id'], $i['status'] ? 'Enabled' : 'Disabled'), sprintf(
                    "<div>
                    <a href='%s' class='btn btn-info edit' %s data-id='%s'>Edit</a>
                    <a href='%s' class='btn btn-danger %s' %s>Delete</a>
                </div>",
                    ROOT . "ajax/categories/editItem?id=" . $i['id'],
                    isset($_SESSION['category']) && $_SESSION['category'][1] ? "data-bs-toggle='modal' data-bs-target='#editCategory' onclick='editCategory(event)'" : 'onclick="return false"',
                    $i['id'],
                    ROOT . "ajax/categories/delete?id=" . $i['id'],
                    isset($_SESSION['category']) && $_SESSION['category'][1] ? "delete-record" : '',
                    isset($_SESSION['category']) && $_SESSION['category'][1] ? "" : 'onclick="return false"',
                ));
            }
            return $str;
        }
        $res['not-authorized'] = '1';
        return $res;
    }
    public function editStatus($id)
    {
        $res = [];
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT) or 0;
        if (isset($_SESSION['category']) && $_SESSION['category'][1]) {
            $db = DB::get_instance();
            $data = $db->read("SELECT `status` FROM categories WHERE id =? LIMIT 1", [$id], true, false);
            $status = isset($data[0][0]['status']) ? $data[0][0]['status'] : 10;
            if ($status != 10) {
                $db->write("UPDATE categories SET `status` =? WHERE id =?", [$status ? 0 : 1, $id]);
                $res['success'] = '1';
            }
            else
                $res['not-exists'] = '1';
        }
        else
            $res['not-authorized'] = '1';

        return $res;
    }
    public function delete($id)
    {
        $res = [];
        if (isset($_SESSION['category']) && $_SESSION['category'][1]) {
            $db = DB::get_instance();
            $data = $db->read("SELECT id FROM categories WHERE id =? LIMIT 1", [$id], true, false);
            $id = isset($data[0][0]['id']) ? $data[0][0]['id'] : null;
            if ($id && is_numeric($id)) {
                $db->write("DELETE FROM categories WHERE id =?", [$id]);
                $res['success'] = '1';
            }
            else
                $res['not-exists'] = '1';
        }
        else
            $res['not-authorized'] = '1';
        return $res;
    }
}