<?php

namespace Core;

/**
 * Class Auth
 * @package Core
 *
 */
class Auth
{

    /**
     * @param $user
     * @param string $guard
     */
    public static function login($user, $guard = 'user')
    {
        $_SESSION[$guard] = $user;
    }

    /**
     * return logged in guard user
     *
     * @param string $guard
     * @return mixed
     */
    public static function user($guard = 'user')
    {
        return $_SESSION[$guard];
    }

    /**
     * logged out guard user
     *
     * @param string $guard
     */
    public static function logout($guard = 'user')
    {
       unset($_SESSION[$guard]);
    }

    /**
     * check is given guard user logged in
     *
     * @param string $guard
     * @return bool
     */
    public static function check($guard){
        return isset($_SESSION[$guard]) && $_SESSION[$guard];
    }
}

