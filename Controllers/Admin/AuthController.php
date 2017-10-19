<?php

namespace Controllers\Admin;

use Models\User;
use Core\Auth;
use Core\Request;

/**
 * Class AuthController
 * @package Controllers\Admin
 */
class AuthController
{

    /**
     * returns login page if user not logged in, otherwise redirect to user dashboard
     */
    public function loginView()
    {
        if (!Auth::check('admin')) {
            return view('auth/login',['admin' => true]);
        }

        return redirect('admin/dashboard');
    }

    /**
     * logout user
     */
    public function logout()
    {
        if (Auth::check('admin')) {
           Auth::logout('admin');
        }

        return redirect('admin/login');
    }

    /**
     * login user
     */
    public function login()
    {
        if (!Auth::check('admin')) {
            Request::set();
            $request = Request::get();

            //validate request params
            $errors = $this->validateLoginInput($request);
            if(!count($errors)) {
                $userModel = new User();
                $user = $userModel->getUserByEmail($request['email']);

                if (!$user) {
                    $errors['email'] = "This email does't registererd with us.";
                }elseif($user['password'] != md5($request['password'])) {
                    $errors['password'] = "Wrong password.";
                }

            }

            if (count($errors)) {
                return view('auth/login', ['errors' => $errors,'data' => $request,'admin' => true]);
            }else{
                Auth::login($user,'admin');
                return redirect('admin/dashboard');
            }

        }

        return redirect('admin/dashboard');
    }

    /**
     * validate request data
     *
     * @param array $request
     * @return array
     */
    private function validateLoginInput($request)
    {
        $errors = [];

        if (!isset($request['email']) || !$request['email']) {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please provide a valid email.';
        }

        if (!isset($request['password']) || !$request['password']) {
            $errors['password'] = 'Password is required';
        }

        return $errors;
    }


}