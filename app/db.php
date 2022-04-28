<?php

namespace App;

use PDO;

class db
{
    private $host = 'localhost';
    private $database = 'tiny-url';
    private $username = 'root';
    private $password = '';
    private $db = null;
    private static $instance = null;

    private function __clone() {}
    private function __construct() {
        try {
            $this->db = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->database,
                $this->username,
                $this->password
            );
            $this->db->exec('set names utf8');
        } catch(PDOException $exception){
            echo 'Db connection error: ' . $exception->getMessage();
        }
    }

    public static function getInstance():self
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function query(string $sql, $params = [], bool $returnFirstValue = false)
    {
        $stmt = $this->db->prepare($sql);
        if ( !empty($params) ) {

            foreach ($params as $key => $value) {
                $resultValue = $value;

                if(is_array($value)) {
                    $resultValue = $value['value'];
                    $dataType = constant('PDO::' . $value['type']);
                }

                $stmt->bindValue(
                    ':' . $key,
                    $resultValue,
                    $dataType ?? PDO::PARAM_STR
                );
            }
        }

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($returnFirstValue) {
            return $data[0];
        }
        return $data;
    }
}