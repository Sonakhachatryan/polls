<?php
    function view($file, $params = [])
    {

        foreach ($params as $key => $param) {
            $$key = $param;
        }

        include('views/' . $file . '.php');

    }

    function url($url)
    {
        $base = Core\Config::get('baseUrl');

        return $base . '/' . $url;
    }

    function dd()
    {
        $args = func_get_args();
        echo "<pre>";
        foreach ($args as $arg) {
            var_dump($arg);
            echo "<br>";
        }
        die;
    }

    function redirect($url)
    {
        return header('Location:' . url($url));
    }

    function generate_csrf_token()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 255; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }

        return $randstring;
    }

    function csrf_token()
    {
        return $_SESSION['token'];
    }