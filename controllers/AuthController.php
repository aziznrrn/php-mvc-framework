<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->view('auth/login');
    }

    public function handleLogin(Request $request)
    {
        $body = $request->getBody();

        var_dump($body);
    }

    public function register()
    {
        $this->setLayout('auth');
        return $this->view('auth/register');
    }

    public function handleRegister(Request $request)
    {
        $body = $request->getBody();

        var_dump($body);
    }
}