<?php

class User
{

    public function register($POST)
    {
        /**
         * Sign Up User
         * 
         * This function used to add new user to database
         * 
         * @param array $POST Form Data
         * 
         * @return array $res results
         */

        $res = [];
        $username = htmlspecialchars(trim($POST['username']));
        $email = htmlspecialchars(trim($POST['email']));
        $pass = htmlspecialchars(trim($POST['password']));
        $confirm_pass = htmlspecialchars(trim($POST['confirm-password']));
        $first_name = htmlspecialchars(trim($POST['first-name']));
        $last_name = htmlspecialchars(trim($POST['last-name']));
        $mobile = htmlspecialchars(trim($POST['mobile-number']));
        $db = db::get_instance();
        if (!$username || is_numeric($username))
            $res['valid-username'] = '1';
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL))
            $res['valid-email'] = '1';
        if (!ctype_alpha($first_name))
            $res['valid-first-name'] = '1';
        if ($last_name && !ctype_alpha($last_name))
            $res['valid-last-name'] = '1';
        if (strlen($pass) < 4)
            $res['pass'] = '1';
        if ($pass != $confirm_pass)
            $res['pass-match'];
        if ($mobile && (!is_numeric($mobile) || strlen($mobile) != 11))
            $res['valid-phone'] = '1';
        if (!$res) {
            $found = $db->read("SELECT email,username FROM users WHERE email=? OR username=?", [$email, $username], true);
            if ($found[1]) {
                if ($found[0][0]['email'] == $email)
                    $res['email-exists'] = '1';
                else
                    $res['username-exists'] = '1';
            } else {
                $db->write(
                    "INSERT INTO 
                        users (
                            first_name , 
                            last_name , 
                            username , 
                            password , 
                            email , 
                            status, 
                            rule,
                            phone
                        ) 
                        VALUES
                            (?,?,?,?,?,?,?,?)",
                    [
                        $first_name,
                        $last_name,
                        $username,
                        sha1($pass),
                        $email,
                        1,
                        $db->read("SELECT id FROM roles WHERE name=?", ['client'], true)[0][0]['id'],
                        $mobile
                    ]
                );
                $res['success'] = '1';
            }
        }
        // echo "Deon";
        return $res;
    }
    public function Login($POST, $returnData = false)
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
        $user = htmlspecialchars($POST['user']);
        $pass = htmlspecialchars($POST['password']);
        $db = db::get_instance();
        if (strlen($pass) < 4)
            $res['pass'] = '1';
        if (!$res) {
            $found = $db->read("SELECT users.id , users.first_name , users.last_name , users.email , users.verified, users.status, roles.name as rule , avatar,status  FROM users JOIN roles ON roles.id=users.rule WHERE  ((email =? OR username=?) AND password=?) LIMIT 1", [$user, $user, sha1($pass)], true);
            if ($found[1]) {
                $_SESSION['data'] = $found[0][0];
                if ($_SESSION['data']['verified'] == 1) {
                    if ($_SESSION['data']['status'] == 2)
                        $res['success'] = '1';
                    else if ($_SESSION['data']['status'] == 1)
                        $res['pending'] = '1';
                    else
                        $res['rejected'] = '1';
                } else
                    $res['verify'] = '1';
            } else {
                $res['not-exists'] = '1';
            }
        }
        return $res;
    }

    public function loginGoogle($POST, $is_client = false)
    {
        $db = DB::get_instance();
        $res = [];
        $id = $POST['id'];
        $first_name = $POST['givenName'];
        $last_name = $POST['familyName'];
        $verify = $POST['verifiedEmail'];
        $avatar = $POST['picture'];
        $email = $POST['email'];
        $userdata = $db->read("SELECT users.id , users.first_name , users.last_name , users.email , users.verified, users.status, roles.name as rule , avatar,status  FROM users JOIN roles ON roles.id=users.rule WHERE google_id=? OR email=? LIMIT 1", [$id, $email], true);
        if ($userdata[1]) {
            $res['success'] = '1';
            $res['data'] = $userdata[0][0];
        } else {
            $image_extension = explode("/", get_headers($avatar, 1)['Content-Type'])[1];
            $image_name = rand(2e6, 3e6) . "__" . rand(2e6, 3e6) . "." . $image_extension;
            $handle = fopen("./uploads/users/" . $image_name, 'w');
            fwrite($handle, file_get_contents($avatar));
            fclose($handle);
            $client_role = $db->read("SELECT id FROM roles WHERE name =?", ['client'], true)[0][0]['id'];
            $db->write(
                "INSERT INTO users(first_name , last_name , username ,email , password , avatar , verified , status , google_id , gender , rule)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)
                ",
                [$first_name, $last_name, $id, $email, rand(2e6, 3e6) . $id . rand(2e6, 3e6), $image_name, $verify, $is_client ? 2 : 1, $id, $POST['gender'], $client_role]
            );
            $res['data'] = $db->read("SELECT  users.id , users.first_name , users.last_name , users.email , users.verified, users.status, roles.name as rule , avatar,status  FROM users JOIN roles ON roles.id=users.rule WHERE  google_id=? OR email=? LIMIT 1", [$id, $email], true)[0][0];
            $res['success'] = '1';
        }
        return $res;
    }
    public function add_admin($POST)
    {
        $res = [];
        if (isset($_SESSION['user']) && $_SESSION['user'][2]) {
            $name = trim(htmlspecialchars($POST['name']));
            $username = trim(htmlspecialchars($POST['username']));
            $password = trim(htmlspecialchars($POST['password']));
            $email = trim(htmlspecialchars($POST['email']));
            $role = isset($POST['role_id']) ? filter_var(htmlspecialchars($POST['role_id']), FILTER_SANITIZE_NUMBER_INT) : "";
            if (!ctype_alpha($name))
                $res['name'] = '1';
            if (!$username)
                $res['username'] = '1';
            if (!$password)
                $res['pass'] = '1';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                $res['email'] = '1';
            if (!$role)
                $res['role'] = '1';
            if (!$res) {
                $db = DB::get_instance();
                if ($db->read("SELECT username FROM users WHERE username =?", [$username])[0])
                    $res['username-exists'] = '1';
                if ($db->read("SELECT email FROM users WHERE email =?", [$email])[0])
                    $res['email-exists'] = '1';
                if (!$db->read("SELECT id FROM roles WHERE id =?", [$role])[0])
                    $res['role-not-exists'] = '1';
                if (!$res) {
                    $db->write("INSERT INTO users (first_name , username ,email , password , status , verified , rule) VALUES(?,?,?,?,?,?,?)", [$name, $username, $email, sha1($password), 2, 1, $role]);
                    $res['success'] = '1';
                }
            }
        } else
            $res['not-authorized'] = '1';
        return $res;
    }
    public function edit_admin($POST)
    {
        $res = [];
        if (isset($_SESSION['user']) && $_SESSION['user'][1]) {
            $name = trim(htmlspecialchars($POST['name']));
            $username = trim(htmlspecialchars($POST['username']));
            $password = trim(htmlspecialchars($POST['password']));
            $email = trim(htmlspecialchars($POST['email']));
            $role = isset($POST['role_id']) ? filter_var(htmlspecialchars($POST['role_id']), FILTER_SANITIZE_NUMBER_INT) : "";
            $id = filter_var($POST['id'], FILTER_SANITIZE_NUMBER_INT);
            if (!$name)
                $res['name'] = '1';
            if (!$username)
                $res['username'] = '1';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                $res['email'] = '1';
            if (!$role)
                $res['role'] = '1';
            if (!$id)
                $res['id'] = '1';
            if (!$res) {
                $db = DB::get_instance();
                if ($db->read("SELECT username FROM users WHERE (username =? OR google_id=?) AND id!=?", [$username, $username, $id])[0])
                    $res['username-exists'] = '1';
                if ($db->read("SELECT email FROM users WHERE email =? AND id!=?", [$email, $id])[0])
                    $res['email-exists'] = '1';
                if (!$res) {
                    $query = "UPDATE users SET first_name=? , username=? ,email=? ,rule=? ";
                    $query .= $password ? "password=? " : " ";
                    $query .= "WHERE id =?";
                    $exarray = $password ? [$name, $username, $email, $role, sha1($password), $id] : [$name, $username, $email, $role, $id];
                    $db->write("UPDATE users SET first_name=? , username=? ,email=? , password=?,rule=? WHERE id =?", [$name, $username, $email, sha1($password), $role, $id]);
                    if ($id = $_SESSION['data']['id']) {
                        $res['same'] = '1';
                    }
                    $res['success'] = '1';
                }
            }
        } else
            $res['not-authorized'] = '1';
        return $res;
    }
    function edit_status_admin($id, $status)
    {
        $res = [];
        if (isset($_SESSION['user']) && $_SESSION['user'][1]) {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $status = (int)filter_var($status, FILTER_SANITIZE_NUMBER_INT);
            if (!$id)
                $res['id'] = '1';
            if ($status < 0 || $status > 2)
                $res['status'] = '1';
            if (!$res) {
                $db = DB::get_instance();
                if (!$db->read("SELECT id FROM users WHERE id =$id", []))
                    $res['user-not-exists'] = '1';
                else {
                    if ($status == 2)
                        $status = 0;
                    else
                        $status++;
                    $db->write("UPDATE users SET status =? WHERE id =$id", [$status]);
                    $res['success'] = '1';
                    if ($id == $_SESSION['data']['id'])
                        $res['same'] = '1';
                }
            }
        } else
            $res['not-authorized'] = '1';
        return $res;
    }
    public function delete_admin($id)
    {
        $res = [];
        if (isset($_SESSION['user']) && $_SESSION['user'][1]) {
            $db = db::get_instance();
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            if ($db->read("SELECT id FROM users WHERE id =?", [$id])[0]) {
                $db->write("DELETE FROM users WHERE id =?", [$id]);
                $res['success'] = '1';
                if ($id == $_SESSION['data']['id']) {
                    if (file_exists("../public/uploads/users/{$_SESSION['data']['avatar']}"))
                        unlink("../public/uploads/users/{$_SESSION['data']['avatar']}");
                    $res['same'] = '1';
                }
            } else
                $res['not-exists'] = '1';
        } else
            $res['not-authorized'] = '1';
        return $res;
    }
    function get_user($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $res = [];
        if (!$id)
            $res['id'] = '1';
        if (!$res) {
            $db = DB::get_instance();
            if (!$db->read("SELECT first_name , username , email , rule FROM users WHERE id =?", [$id])[0])
                $res['not-exists'] = '1';
            else {
                $res['data'] = $db->read("SELECT first_name , email , username , rule FROM users WHERE id =$id", [], true)[0][0];
                $res['success'] = '1';
            }
        }
        return $res;
    }
    function get_users()
    {
        $db = DB::get_instance();
        $str = "";
        foreach ($db->read("SELECT users.id ,users.first_name , users.email , roles.name as role_name , users.status FROM users JOIN roles ON roles.id=users.rule", [], true)[0] as $i) {
            $str .= sprintf(
                "<tr>
            <td style='text-transform:capitalize'>%s</td>
            <td>%s</td>
            <td style='text-transform:capitalize'>%s</td>
            <td><a href='%s' sts-id='%s' onclick='%s' data-id='%s'><span class='badge rounded-pill badge-light-%s'>%s</span></a></td>
            <td class='d-inline-flex justify-content-around'>%s</td>
            </tr>",
                $i['first_name'],
                $i['email'],
                $i['role_name'],
                ROOT . 'ajax/users/editStatus',
                $i['status'],
                isset($_SESSION['user']) && $_SESSION['user'][1] ? "editUserStatus(event)" : "return false",
                $i['id'],
                $i['status'] == '0' ? 'danger' : ($i['status'] == '1' ? 'warning' : 'success'),
                $i['status'] == '0' ? 'rejected' : ($i['status'] == '1' ? 'pending' : 'active'),
                sprintf(
                    "
                <a href='%s' class='btn btn-primary btn-sm' onclick='%s' %s data-id='%s'>Edit</a>
                <a href='%s' class='btn btn-danger btn-sm' data-id='%s' onclick='%s'>Delete</a>
            ",
                    ROOT . "ajax/users/edit",
                    isset($_SESSION['user']) && $_SESSION['user'][1] ? "editUser(event)" : "return false",
                    isset($_SESSION['user']) && $_SESSION['user'][1] ? "data-bs-toggle='modal' data-bs-target='#editUser'" : "",
                    $i['id'],
                    ROOT . "ajax/users/delete",
                    $i['id'],
                    isset($_SESSION['user']) && $_SESSION['user'][1] ? "deleteUser(event)" : "return false",

                )
            );
        }
        return $str;
    }
    public function edit($POST, $FILES)
    {
        $first_name = trim(htmlspecialchars($POST['first_name']));
        $last_name = trim(htmlspecialchars($POST['last_name']));
        $image_name = "";
        $res = [];
        if (!$first_name || !is_string($first_name))
            $res['first-name'] = '1';
        if (isset($FILES['avatar']) && !$FILES['avatar']['error']) {
            $image = $FILES['avatar'];
            if (explode("/", $image['type'])[0] != 'image')
                $res['image'] = '1';
            if ($image['size'] > 1e6)
                $res['image-size'] = '1';
            if (!$res) {
                $tmp_name = $image['tmp_name'];
                $name = rand(1e6, 3e6) . "_" . rand(2e6, 3e6) . "." . explode("/", $image['type'])[1];
                if (!file_exists("../public/uploads/users"))
                    mkdir("../public/uploads/users", 0777, true);
                move_uploaded_file($tmp_name, "../public/uploads/users/$name");
                $image_name = $name;
            }
        }
        if (!$res) {
            $db = DB::get_instance();
            $db->read("UPDATE users SET first_name =? , last_name=? , avatar=? WHERE id =?", [$first_name, $last_name, $image_name ? $image_name : "avatar.png", $_SESSION['data']['id']]);
            $res['success'] = '1';
            $data = [];
            $data['first_name'] = $first_name;
            $data['last_name'] = $last_name;
            $data['email'] = $_SESSION['data']['email'];
            $data['verified'] = $_SESSION['data']['verified'];
            $data['status'] = $_SESSION['data']['status'];
            $data['rule'] = $_SESSION['data']['rule'];
            $data['id'] = $_SESSION['data']['id'];
            if ($image_name) {
                if (file_exists("../public/uploads/users/{$_SESSION['data']['avatar']}"))
                    unlink("../public/uploads/users/{$_SESSION['data']['avatar']}");
            }
            $data['avatar'] = $image_name ? $image_name : $_SESSION['data']['avatar'];
            session_unset();
            session_destroy();
            session_start();
            $_SESSION['data'] = $data;
            $this->authorized();
        }
        return $res;
    }
    public function edit_password($POST)
    {
        $old = trim($POST['old-pass']);
        $new = trim($POST['new-pass']);
        $repeat = trim($POST['repeat-new-pass']);
        $res = [];
        if (!$old)
            $res['current-pass'] = '1';
        if (!$new)
            $res['new-pass'] = '1';
        if (!$repeat)
            $res['repeat-pass'] = '1';
        if ($new != $repeat)
            $res['not-match'] = '1';
        if (!$res) {
            $db = DB::get_instance();
            $user_pass = $db->read("SELECT password FROM users WHERE id =?", [$_SESSION['data']['id']], true, false)[0][0]['password'];
            if (sha1($old) != $user_pass)
                $res['wrong-pass'] = '1';
            else {
                $db->write("UPDATE users SET password=? WHERE id =?", [sha1($new), $_SESSION['data']['id']]);
                $res['success'] = '1';
            }
        }
        return $res;
    }

    public function delete($id)
    {
        $db = db::get_instance();
        $res = [];
        if ($db->read("SELECT id FROM users WHERE id =?", [$id])) {
            $db->write("DELETE FROM users WHERE id =?", [$id]);
            $res['success'] = '1';
            if (file_exists("../public/uploads/users/{$_SESSION['data']['avatar']}"))
                unlink("../public/uploads/users/{$_SESSION['data']['avatar']}");
            if ($id == $_SESSION['data']['id'])
                $res['same'] = '1';
        } else
            $res['not-exists'] = '1';
        return $res;
    }
    public function loggedIn()
    {
        return isset($_SESSION['data']['id']) && isset($_SESSION['data']['status']) && $_SESSION['data']['status'] == '2' && $_SESSION['data']['rule'] != 'client';
    }
    public function loggedInClient()
    {
        return isset($_SESSION['client']['id']) && isset($_SESSION['client']['status']) && $_SESSION['client']['status'] == '2';
    }

    public function verify($POST)
    {
        $db = DB::get_instance();
        $data = $db->read("SELECT code , expires FROM users WHERE id =?", [isset($_SESSION['data']['id']) ? $_SESSION['data']['id'] : 0], true, false);
        $res = [];
        if (isset($data[0][0])) {
            $data = $data[0][0];
            $code = htmlspecialchars($POST['code']);
            if (date("Y-m-d H:i:s") <= $data['expires']) {
                if ($data['code'] == substr($code, 0, 6)) {
                    $db->write("UPDATE users SET verified=1 WHERE id =?", [$_SESSION['data']['id']]);
                    $res['success'] = '1';
                    $_SESSOIN['data']['verified'] = 1;
                } else
                    $res['wrong'] = '1';
            } else
                $res['expired'] = '1';
        } else
            $res['not-exists'] = '1';
        return $res;
    }

    public function get_roles()
    {
        $db = DB::get_instance();
        return $db->read("SELECT name , id FROM roles", [], true, false)[0];
    }

    public function authorized()
    {
        $id = $_SESSION['data']['id'];
        $db = DB::get_instance();
        $res = $db->read("SELECT * FROM roles WHERE id = (SELECT rule FROM users WHERE id =?)", [$id], true);
        if ($res[0]) {
            $res = $res[0][0];
            $_SESSION['user'] = json_decode($res['user']);
            $_SESSION['category'] = json_decode($res['categories']);
            $_SESSION['product'] = json_decode($res['products']);
            $_SESSION['order'] = json_decode($res['orders']);
            $_SESSION['role'] = json_decode($res['roles_s']);
            $_SESSION['db'] = json_decode($res['db']);
            return true;
        }
        return false;
    }

    // Client Area

    public function login_client($POST)
    {
        $user = isset($POST['user']) ? trim(htmlspecialchars($POST['user'])) : null;
        $pass = isset($POST['pass']) ? trim(htmlspecialchars($POST['pass'])) : null;
        $res = [];
        $db = DB::get_instance();
        $data = $db->read("SELECT id , first_name ,last_name, email,`status`  FROM users WHERE (username=? or email=?) AND password =? AND rule=(SELECT id FROM roles WHERE name =?)", [$user, $user, sha1($pass), "client"], true);
        if ($data[1]) {
            $res['success'] = '1';
            $_SESSION['client'] = $data[0][0];
        } else
            $res['user-not-exists'] = '1';
        return $res;
    }
    public function register_client($POST)
    {
        $username = isset($POST['username']) ? trim(htmlspecialchars($POST['username'])) : null;
        $name = isset($POST['name']) ? trim(htmlspecialchars($POST['name'])) : null;
        $email = isset($POST['email']) ? trim(htmlspecialchars($POST['email'])) : null;
        $pass = isset($POST['pass']) ? trim(htmlspecialchars($POST['pass'])) : null;
        $res = [];
        if (!$username)
            $res['username'] = '1';
        if (!$name)
            $res['name'] = '1';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $res['email'] = '1';
        if (!$pass)
            $res['pass'] = '1';
        if (!$res) {
            $db = DB::get_instance();
            $data = $db->read("SELECT username , email FROM users WHERE (username=? or email=?)", [$username, $email], true);
            if ($data[1]) {
                if ($username == $data[0][0]['username'])
                    $res['username-exists'] = '1';
                if ($email == $data[0][0]['email'])
                    $res['email-exists'] = '1';
            } else {
                $data = $db->read("INSERT INTO users (username , email ,first_name ,password , status , rule) VALUES (?,?,?,?,?,?)", [$username, $email, $name, sha1($pass), 2, $db->read("SELECT id FROM roles WHERE name =?", ['client'], true)[0][0]['id']]);
                $res['success'] = '1';
            }
        }
        return $res;
    }
}
