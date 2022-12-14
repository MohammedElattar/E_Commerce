<?php


class Controller

{
    /**
     * Controller
     *
     * @author  Mohamed Attar
     */

    public function view($path, $data = [])
    {
        /**
         * View The UI Content
         * 
         * returns a UI Content
         * 
         * @param string $path The path of the file
         * 
         * @param Array $data  data you want to pass to show for example Title Of The Page
         */
        if (file_exists("../app/views/$path.php")) {
            include "../app/views/$path.php";
        } else
            header("Location:" . ROOT . "admin/not_found");
    }
    public function load_model($model_name)
    {
        /**
         * Load Models
         * 
         * returns An Class Object Of Desired Model
         * 
         * @param string $model_name The Model You Want To Call.
         *
         * @return string Returns The File Name of desired model
         */

        if (file_exists("../app/models/" . strtolower($model_name) . ".class.php")) {
            include "../app/models/" . strtolower($model_name) . ".class.php";
            return new $model_name();
        }
    }
    public function logged()
    {
        $user = $this->load_model("User");
        return $user->loggedIn();
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    public function not_authorized_admin()
    {
        $status = isset($_SESSION['data']['status']) ? $_SESSION['data']['status'] : '-1';
        header("Location:" . ROOT . "admin/" . ($status == '0' ? 'rejected' : ($status == '1' ? 'pending' : 'not_authorized')));
    }
}
