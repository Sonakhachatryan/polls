<?php
namespace Core;

/**
 * Class Config
 * @package Core
 */
class Config
{
    private static $keys = [
        'db' => [
            'dbName' => 'polls',
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => ''
        ],
        'baseUrl' => 'http://aod.dev'
    ];

    public static function get($key)
    {
        $key_array = explode('/',$key);

        $res = self::$keys;
        foreach($key_array as $key){
            $res = $res[$key];
        }

        return $res;
    }
}