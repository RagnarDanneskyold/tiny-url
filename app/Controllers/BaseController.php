<?php

namespace App\Controllers;

use App\db;

class BaseController
{

    protected $urlsTable = 'urls';

    static function json ($data, $code = 200, $header = 'Content-type: application/json; charset=utf-8')
    {
        header($header);
        http_response_code($code);
        echo json_encode($data);
    }

    static function dbQuery (string $query) {
        $db = db::getInstance();
        return $db->query($query);
    }

    static function getAdapter () {
        return db::getInstance();
    }
}