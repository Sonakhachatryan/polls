<?php

namespace Controllers;

use Models\User;
use Core\Auth;
use Core\Request;

/**
 * Class AuthController
 * @package Controllers
 */
class AuthController
{

    /**
     * returns login page if user not logged in, otherwise redirect to user dashboard
     */
    public function loginView()
    {
        if (!Auth::check('user')) {
            return view('auth/login');
        }

        return redirect('/dashboard');
    }

    /**
     * returns register page if user not logged in, otherwise redirect to user dashboard
     */
    public function registerView()
    {
        if (!Auth::check('user')) {
            return view('auth/register');
        }

        return redirect('/dashboard');
    }

    /**
     * register new user
     */
    public function register()
    {
        Request::set();
        $request = Request::get();

        //validate request params
        $this->validateRegisterInput($request);
    }

    /**
     * validate request data
     *
     * @param array $request
     * @return array
     */
    private function validateRegisterInput($request)
    {
        $errors = [];

        if (!isset($request['name']) || !$request['name']) {
            $errors['name'] = 'Name is required.';
        }

        if (!isset($request['email']) || !$request['email']) {
            $errors['email'] = 'Email is required.';
        }

        if (!isset($request['password']) || !$request['password']) {
            $errors['password'] = 'Password is required';
        } elseif (!isset($request['password_confirmation']) || $request['password'] != $request['password_confirmation']){
            $errors['password'] = 'Passwords does not mutch.';
        }

        if (!isset($request['password_confirmation']) || !$request['password_confirmation']) {
            $errors['password_confirmation'] = 'Confirm password is required';
        }

        //todo contine validation
        return $errors;
    }

}