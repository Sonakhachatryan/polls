<?php

namespace Core;

/**
 * Class Request
 * @package Core
 *
 * @property array $data
 */
class Request
{
    /**
     * @var array
     */
    protected static $data = [];

    /**
     * get all request data from $_GET and $_POST
     */
    public static function set()
    {
        foreach ($_GET as $key => $item) {
            self::$data[$key] = htmlspecialchars($item);
        }

        foreach ($_POST as $key => $item) {
            if(is_array($item)){
                foreach($item as $k => $v){
                    self::$data[$key][$k] = htmlspecialchars($v);
                }
            }else {
                self::$data[$key] = htmlspecialchars($item);
            }
        }

        $_SESSION['request_data'] = self::$data;

    }

    /**
     * return request key if $prop is set or all request data
     *
     * @param string $prop @default null
     * @return array
     */
    public static function get($prop = NULL)
    {
        if($prop) {
            return self::$data[$prop];
        }

        return self::$data;
    }

}

