<?php


/*
 => Steps to add a new Role to db
 1 -> add in users.php file in roles assosiative array
 2 -> add in type array in add and edit in role.class.php file
 3 -> add in app-access-roles.js file in construct function
 4 - > add in app-access-roles.js file in 
 */
class Role
{

    public function add($POST)
    {
        /**
         * Login User
         * This function used to authenticate the user to access the website
         * 
         * @param array $POST Form Data
         * 
         * @return array $res results
         */

        $res = [];
        if (isset($_SESSION['role']) && $_SESSION['role'][2]) {
            $name = strtolower(trim(htmlspecialchars($POST['name'])));
            // add new role here
            $type = ['user', 'categories', 'products', 'orders', 'db', 'roles_s'];
            $permissions = ['Read', 'Write', 'Create'];
            // add new role here
            $user = "";
            $categories = "";
            $products = "";
            $orders = "";
            $database = "";
            $roles = "";
            if (!$name)
                $res['name'] = '1';
            if (count($POST) == 1 && isset($POST['name']))
                $res['permission'] = '1';
            foreach ($type as $i) {
                foreach ($permissions as $j) {
                    // add new role here

                    if ($i == 'user')
                        $user .= isset($POST[$i . $j]) ? " 1" : " 0";
                    else if ($i == 'categories')
                        $categories .= isset($POST[$i . $j]) ? " 1" : " 0";
                    else if ($i == 'products')
                        $products .= isset($POST[$i . $j]) ? " 1" : " 0";
                    else if ($i == 'orders')
                        $orders .= isset($POST[$i . $j]) ? " 1" : " 0";
                    else if ($i == 'roles_s')
                        $roles .= isset($POST[$i . $j]) ? " 1" : " 0";
                    else
                        $database .= isset($POST[$i . $j]) ? " 1" : " 0";
                }
            }
            // add new role here
            $user = json_encode(explode(" ", trim($user)));
            $categories = json_encode(explode(" ", trim($categories)));
            $products = json_encode(explode(" ", trim($products)));
            $orders = json_encode(explode(" ", trim($orders)));
            $database = json_encode(explode(" ", trim($database)));
            $roles = json_encode(explode(" ", trim($roles)));
            $db = db::get_instance();
            if (!$res) {
                $found = $db->read("SELECT name  FROM roles WHERE name=?", [$name]);
                if ($found[0])
                    $res['exists'] = '1';
                else {
                    // add new role here
                    $db->write("INSERT INTO roles (name , user,categories ,products , orders,db , roles_s) VALUES(?,?,?,?,?,?,?)", [$name, $user, $categories, $products, $orders, $database, $roles]);
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
         * Login User
         * This function used to authenticate the user to access the website
         * 
         * @param array $POST Form Data
         * 
         * @return array $res results
         */

        $res = [];
        if (isset($_SESSION['role']) && $_SESSION['role'][1]) {

            $name = strtolower(trim(htmlspecialchars($POST['name'])));
            // add new role here

            $type = ['user', 'categories', 'products', 'orders', 'db', 'roles_s'];
            $permissions = ['Read', 'Write', 'Create'];
            $id = filter_var($POST['id'], FILTER_SANITIZE_NUMBER_INT);
            // add new role here
            $user = "";
            $categories = "";
            $products = "";
            $orders = "";
            $database = "";
            $roles = "";
            if (!$name)
                $res['name'] = '1';
            if (count($POST) == 1 && isset($POST['name']))
                $res['permission'] = '1';
            foreach ($type as $i) {
                foreach ($permissions as $j) {
                    // add new role here
                    if ($i == 'user')
                        $user .= isset($POST[$i . $j]) ? " 1" : " 0";
                    else if ($i == 'categories')
                        $categories .= isset($POST[$i . $j]) ? " 1" : " 0";
                    else if ($i == 'products')
                        $products .= isset($POST[$i . $j]) ? " 1" : " 0";
                    else if ($i == 'orders')
                        $orders .= isset($POST[$i . $j]) ? " 1" : " 0";
                    else if ($i == 'roles_s')
                        $roles .= isset($POST[$i . $j]) ? " 1" : " 0";
                    else
                        $database .= isset($POST[$i . $j]) ? " 1" : " 0";
                }
            }
            // add new role here
            $user = json_encode(explode(" ", trim($user)));
            $categories = json_encode(explode(" ", trim($categories)));
            $products = json_encode(explode(" ", trim($products)));
            $orders = json_encode(explode(" ", trim($orders)));
            $database = json_encode(explode(" ", trim($database)));
            $roles = json_encode(explode(" ", trim($roles)));
            $db = db::get_instance();
            if (!$res) {
                $found = $db->read("SELECT name  FROM roles WHERE name=? AND id !=?", [$name, $id]);
                if ($found[0])
                    $res['exists'] = '1';
                else {
                    // add new role here
                    if ($db->read("SELECT id FROM roles WHERE name =?", ['client'], true)[0][0]['id'] == $id)
                        $res['not-exists'] = '1';
                    else {
                        $db->write("UPDATE roles SET name=? , user=?,categories=? ,products=?,orders=?,db=?,roles_s=? WHERE id =?", [$name, $user, $categories, $products, $orders, $database, $roles, $id]);
                        $res['success'] = '1';
                    }
                }
            }
        }
        else
            $res['not-authorized'] = '1';
        return $res;
    }
    public function get_roles()
    {
        $res = [];
        if (isset($_SESSION['role']) && $_SESSION['role'][0]) {
            $db = DB::get_instance();
            $roles = $db->read("SELECT name , id FROM roles WHERE name!=?", ['client'], true, false)[0];
            $users = $db->read("SELECT roles.name as rule FROM users JOIN roles ON users.rule=roles.id", [], true, false)[0];
            $res['roles'] = $roles;
            $res['users'] = $users;
            $res['add-role'] = sprintf('<div class="col-xl-4 col-lg-6 col-md-6 addroledv">
            <div class="card">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end justify-content-center h-100">
                            <img src="%sassets/admin/app-assets/images/illustration/faq-illustrations.svg"
                                class="img-fluid mt-2" alt="Image" width="85" />
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <a href="javascript:void(0)" %s class="stretched-link text-nowrap add-new-role">
                                <span class="btn btn-primary mb-1">Add New Role</span>
                            </a>
                            <p class="mb-0">Add role, if it does not exist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>',
                ROOT,
                isset($_SESSION['role']) && $_SESSION['role'][2] ? 'data-bs-target="#addRoleModal"
        data-bs-toggle="modal"' : '');
        }
        else
            $res['not-authorized'] = '1';
        return $res;
    }
    public function delete($id)
    {
        $res = [];
        if (isset($_SESSION['role']) && $_SESSION['role'][1]) {
            $db = db::get_instance();
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            if ($db->read("SELECT id FROM roles WHERE id =? and name !=?", [$id, 'client'])[0]) {
                $db->write("DELETE FROM roles WHERE id =?", [$id]);
                $res['success'] = '1';
            }
            else
                $res['not-exists'] = '1';
        }
        else
            $res['not-authorized'] = '1';
        return $res;
    }
    public function get_item($id)
    {
        $res = [];
        if (isset($_SESSION['role']) && $_SESSION['role'][1]) {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            if (!$id)
                $res['not-valid'] = '1';
            if (!$res) {
                $db = DB::get_instance();
                $data = $db->read("SELECT * FROM roles WHERE id =?", [$id], true);
                if ($data[1]) {
                    $res['success'] = '1';
                    $res['data'] = $data[0][0];
                }
                else
                    $rs['not-exists'] = '1';
            }
        }
        else
            $res['not-authorized'] = '1';

        return $res;
    }

    function get_users()
    {
        if (isset($_SESSION['user']) && $_SESSION['user'][0]) {
            $db = DB::get_instance();
            $data = $db->read("SELECT first_name , last_name , avatar , roles.name as rule ,email, status FROM users JOIN roles ON users.rule = roles.id", [], true, false)[0];
            return $data;
        }
        $res = [];
        $res['not-authorized-users'] = '1';
        return $res;
    }
    function makeTable($data)
    {
        if (isset($_SESSION['user']) && $_SESSION['user'][0] && !isset($data['not-authorized-users'])) {
            $str = '';
            foreach ($data as $i) {
                $str .= sprintf(
                    "<tr>
            <td>
                <div class='d-flex justify-content-left align-items-center' style='margin-left:50px!important;margin-left:10px:!important'>
                    <div class='avatar-wrapper' style='position:relative'>
                        <div class='avatar me-1' style='position: absolute;top: -30px;left: 18px;'>
                            <img src='%s' alt='avatar' width='32px' height='32px' style='top:-13px;left:20px;'>
                        </div>
                    </div>
                    <div class='d-flex flex-column'>
                    <p class='user_name text-body text-truncate'>%s</p>
                    <small class='emp_post text-muted'>%s</small>
                    </div>
                </div>
            </td>
            <td><span class='text-truncate align-middle'>%s</span></td>
            <td><span class='badge rounded-pill badge-light-%s' style='text-transform:capitalize'>%s</span></td>
            </tr>",
                    ROOT . "uploads/users/" . $i['avatar'],
                    $i['first_name'] . " " . $i['last_name'],
                    $i['email'],
                    $i['rule'],
                    $i['status'] == 0 ? 'danger' : ($i['status'] == 1 ? 'warning' : 'success'),
                    $i['status'] == 0 ? "suspensed" : ($i['status'] == 1 ? 'pending' : 'active')
                );
            }
            return $str;
        }
        $res = [];
        $res['not-authorized'] = '1';
        return $res;
    }
}