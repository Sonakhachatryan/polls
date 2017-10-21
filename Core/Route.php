<?php
namespace Core;
/**
 * Class Route
 * @package Core
 */
class Route{

    private static function call($action, $params = []){
        $a = explode('@', $action);
        $controller = 'Controllers\\' . $a[0];
        $action = $a[1];
        if(count($params)) {
            $obj = new $controller;
            call_user_func_array([$obj, $action], $params);
        }else{
            $obj = new $controller;
            $obj->$action();
        }
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

        if(!isset($_SESSION['csrf_token']) || ($_POST['csrf_token'] != $_SESSION['csrf_token']) ) {
            throw new \Exception('Token mismatch');
        }

        if(! self::compareUrl($url, $action)){
            return;
        }
    }

    public static function compareUrl($url, $action){
        $current_url = $_SERVER['REQUEST_URI'];

        if($url[0] == '/'){
            $formatted_url = $url;
        }
        else{
            $formatted_url = '/'.$url;
        }

        $params = [];
        if(strpos($current_url, '?') ){
            $urlParts = explode('?', $current_url);
            $current_url  = $urlParts[0];
            $paramStr = $urlParts[1];
            foreach( explode('&', $paramStr) as $param){
                $params[explode('=',$param)[0]] = explode('=',$param)[1];
            }
        }

        if ($current_url == $formatted_url) {
            self::call($action, $params);
        }
        else {
            return false;
        }
    }
}

