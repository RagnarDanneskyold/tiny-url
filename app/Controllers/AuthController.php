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
        $loginData = json_decode(file_get_contents("php://input"));
        $isAuth = $this->checkUser($loginData);
        return self::json($isAuth);
    }
    private function checkUser(array $loginData): bool {
        $userData = $this->db->query('SELECT * FROM users WHERE id = 1');
        if (password_verify($loginData['password'], $userData['password'])) {
            return true;
        } else {
            return false;
        }
    }
}