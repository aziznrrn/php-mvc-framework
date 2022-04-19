<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function rules(): array
    {
        return [
            'name' => [
                'required' => true,
                'min' => 3,
                'max' => 255,
            ],
            'email' => [
                'required' => true,
                'email' => true,
            ],
            'password' => [
                'required' => true,
                'min' => 6,
                'max' => 255,
            ],
            'password_confirmation' => [
                'required' => true,
                'min' => 6,
                'max' => 255,
                'match' => 'password',
            ],
        ];
    }
}