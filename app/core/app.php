<?php

class App
{
    protected $controller = "404";
    protected $method = "index";
    protected $params;

    function __construct()
    {

        $url = $this->parseUrl();
        if (isset($url[sizeof($url) - 1]) && !$url[sizeof($url) - 1])
            unset($url[sizeof($url) - 1]);
        if (file_exists('../app/controllers/' . strtolower($url[0]) . ".php")) {
            $this->controller = strtolower($url[0]);
            unset($url[0]);

            require "../app/controllers/$this->controller.php"; // Works !

            $this->controller = new $this->controller;
            if (isset($url[1])) {
                if (method_exists($this->controller, strtolower($url[1]))) {
                    $this->method = strtolower($url[1]);
                    unset($url[1]);
                }
            }
            // * Now working in json format 
            $this->params = $url ? [json_encode($url)] : [json_encode('home')];
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
        else
            header("Location:" . ROOT . "not_found");
    }

    private function parseUrl(): array
    {
        $url = isset($_GET['url']) && $_GET['url'] ? $_GET['url'] : 'home';
        foreach ($_GET as $i => $j) {
            if ($i != 'url')
                $url .= "/$i=$j";
        }
        $url = explode('/', trim($url, " "));
        return $url;
    }
}
