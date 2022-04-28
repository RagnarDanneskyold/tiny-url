<?php
namespace App\Controllers;


class AuthController extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = self::getAdapter();
    }

    public function login() {
        $input = self::getInput();
        $loginData = json_decode(json_encode($input), TRUE);
        $isAuth = $this->checkUser($loginData);
        if ($isAuth === true) {
            session_start();
            self::sessionSet('auth', 'true');
        }
        return self::json($isAuth);
    }

    private function checkUser(array $loginData): bool {
        $userData = $this->db->query(
            'SELECT * FROM ' . $this->usersTable . ' WHERE login = :login',
            ['login' => $loginData['login']],
            true
        );
        if (password_verify($loginData['password'], $userData['password'])) {
            return true;
        } else {
            return false;
        }
    }
}