<?php

namespace Core;

/**
 * Class Auth
 * @package Core
 *
 * @property array $users
 */
class Auth
{
    /**
     * @var array
     */
    protected static $users = [];

    /**
     * @param $user
     * @param string $guard
     */
    public static function login($user, $guard = 'user')
    {
        $_SESSION[$guard] = $user;
        self::$users[$guard] = $user;

    }

    /**
     * return logged in guard user
     *
     * @param string $guard
     * @return mixed
     */
    public static function user($guard = 'user')
    {
        return self::$users[$guard];
    }

    /**
     * logged out guard user
     *
     * @param string $guard
     */
    public static function logout($guard = 'user')
    {
        $_SESSION[$guard] = NULL;
        unset(self::$users[$guard]);
    }

    /**
     * check is given guard user logged in
     *
     * @param string $guard
     * @return bool
     */
    public static function check($guard){
        return isset(self::$users[$guard]) && self::$users[$guard];
    }
}

