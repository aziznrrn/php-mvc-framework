<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

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

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();

        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->save()) {
                return 'Success';
            }
        }
        
        $this->setLayout('auth');
        return $this->view('auth/register', [
            'model' => $registerModel,
        ]);
    }
}