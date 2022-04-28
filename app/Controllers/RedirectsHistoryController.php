<?php

namespace App\Controllers;


class RedirectsHistoryController extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = self::getAdapter();
    }

    public function getRedirectsHistory() {
        session_start();
        if (self::sessionGet('auth') === 'true'){
            if (empty($_GET)) {
                $allUrlsArray = $this->getRedirectsArray();
            } elseif (isset($_GET['filter'])) {
                $allUrlsArray = $this->getRedirectsArray($_GET['filter'], $_GET['value']);
            }

            return self::json($allUrlsArray);
        }

        return self::json('нет доступа');
    }

    private function getRedirectsArray(string $field = null, string $value = null) {
        $query = 'SELECT * FROM ' . $this->redirectsTable . ' r
RIGHT JOIN ' . $this->urlsTable . ' u ON url_id = u.id
WHERE r.url_id IS NOT NULL
        ';
        if (isset($field) && isset($value)) {
            $query .= '
AND ' . $field . ' LIKE "%' . $value . '%"
            ';
        }

        return $this->db->query($query);
    }
}