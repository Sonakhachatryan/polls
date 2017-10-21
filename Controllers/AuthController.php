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

        return redirect('dashboard');
    }

    /**
     * returns register page if user not logged in, otherwise redirect to user dashboard
     */
    public function registerView()
    {
        if (!Auth::check('user')) {
            return view('auth/register');
        }

        return redirect('dashboard');
    }

    /**
     * register new user
     */
    public function register()
    {
        if (!Auth::check('user')) {
            Request::set();
            $request = Request::get();

            //validate request params
            $errors = $this->validateRegisterInput($request);
            if (count($errors)) {
                return view('auth/register', ['errors' => $errors,'data' => $request]);
            }

            $userModel = new User();
            if($userModel->createUser($request)){
                $this->generateAndDeliverEmail($request['email']);
                return view('auth/login', ['deliverd' => true]);
            }
        }

        return redirect('dashboard');
    }

    /**
     * logout user
     */
    public function logout()
    {
        if (Auth::check('user')) {
           Auth::logout();
        }

        return redirect('login');
    }

    /**
     * login user
     */
    public function login()
    {
        if (!Auth::check('user')) {
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
                }elseif ($user['status'] != 1){
                    $errors['other'] = "Your account is not activated yet.Please check your email and follow the link.";
                }

            }

            if (count($errors)) {
                return view('auth/login', ['errors' => $errors,'data' => $request]);
            }else{
                Auth::login($user);
                return redirect('dashboard');
            }

        }

        return redirect('dashboard');
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
        } elseif (filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            $userModel = new User();
            $user = $userModel->getUserByEmail($request['email']);
            if ($user) {
                $errors['email'] = 'Email already exists.';
            }
        } else {
            $errors['email'] = 'Please provide a valid email.';
        }

        if (!isset($request['password']) || !$request['password']) {
            $errors['password'] = 'Password is required';
        } else {
            if(!preg_match('/^(?=.{8,16}$)(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]+$/',$request['password'])){
                $errors['password'] = 'Passwords must contein at least one letter and one number, length must be form 8 to 16.';
            }
            elseif(!isset($request['password_confirmation']) || $request['password'] != $request['password_confirmation']) {
                $errors['password'] = 'Passwords does not mutch.';
            }
        }

        if (!isset($request['password_confirmation']) || !$request['password_confirmation']) {
            $errors['password_confirmation'] = 'Confirm password is required';
        }

        return $errors;
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

    /**
     * send activation mail to user
     *
     * @param $email
     */
    public function generateAndDeliverEmail($email)
    {
        $token = generate_token();
        $url = url('activate?token=' . $token);

        $to      = $email;
        $subject = 'Activation';
        $message = '<p>Please click <a href="' . $url .'">here</a> to activate your account</p>';
        $headers = 'From: sona.khachatryan1995@gmail.com; Content-Type: text/html;';

        mail($to, $subject, $message, $headers);

        $userModel = new User();
        $userModel->updateToken($email,$token);
    }

    /**
     * activate and login user
     *
     * @param $token
     * @return mixed
     */
    public function activate($token)
    {
        $userModel = new User();
        $user = $userModel->updateStatus($token);

        if($user) {
            Auth::login($user);
        }
        return redirect('dashboard');

    }

}