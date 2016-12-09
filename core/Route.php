<?php

class Route{

    private static function call($action, $params = null){
        $a = explode('@', $action);
        $controller = $a[0];
        $action = $a[1];

        $obj = new $controller;
        call_user_func_array(array($obj, $action), $params);
        exit();
    }
    
//    public function getParams($data){
//        $params = '';
//        foreach ($data as $key=>$value){
//            if($key == 0)
//                $params.=$value;
//            else
//                $params=$params.', '.$value;
//        }
//
//        return $params;
//    }

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

        $call = false;
        $params = array();
        if(strpos($formatted_url, '{') && strpos($formatted_url, '}')){

            $arr_url = explode('/', $formatted_url);
            $arr_current = explode('/', $current_url);

            if(count($arr_current) == count($arr_url)){
                $i=0;
                foreach ($arr_url as $key => $value){
                    if($value == $arr_current[$key]){
                        continue;
                    }
                    else{
                        $count = strlen($value);
                        if($value[0] == '{' && $value[$count-1] == '}'){
                            $params[$i] = $arr_current[$key];
                            $i++;
                            $call = true;
                        }
                        else{
                            $call = false;
                            break;
                        }
                    }
                }
            }
        }
        else {
            if ($current_url == $formatted_url) {
                $call = true;
            }
        }

        if($call) {
            self::call($action, $params);
        }
        else {
            return false;
        }
    }
}

