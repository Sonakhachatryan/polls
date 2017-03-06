<?php

class Route{

    private static function call($action, $params = null){
        $a = explode('@', $action);
        $controller = $a[0];
        $action = $a[1];

        $obj = new $controller;
        $obj->$action();
        exit();
    }

    public static function get($url, $action){

        if($_SERVER['REQUEST_METHOD'] != 'GET')
            return;

        if(! self::compareUrl($url, $action)){
            return;
        }
    }

    public static function post($url, $action){
        if($_SERVER['REQUEST_METHOD'] != 'POST')
            return;

        if(! self::compareUrl($url, $action)){
            return;
        }
    }

    public function compareUrl($url, $action){
        $current_url = $_SERVER['REQUEST_URI'];

        if($url[0] == '/'){
            $formatted_url = $url;
        }
        else{
            $formatted_url = '/'.$url;
        }

        $params = array();
        if(strpos($current_url, '?') ){

            $current_url  = explode('?', $current_url)[0];
        }

        if ($current_url == $formatted_url) {
            self::call($action, $params);
        }
        else {
            return false;
        }
    }
}

