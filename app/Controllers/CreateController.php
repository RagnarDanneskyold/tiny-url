<?php

namespace App\Controllers;

class CreateController extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = self::getAdapter();
    }

    public function create() {
        $sourceUrl = json_decode(file_get_contents("php://input"));
        $shortUrl = $this->makeTinyUrl($sourceUrl);

        self::json($shortUrl);
    }

    public function getAllUrls() {
        self::json('testGet');
    }


    private function getTinyUrl(): string {
        $shortUrl = $this->generateUnicId();

        if ($this->isExistShortUrl($shortUrl)) {

            return  $this->getTinyUrl();
        }

        return $shortUrl;
    }

    private function isExistShortUrl(string $shortUrl) {
        $query = '
SELECT id FROM urls WHERE short_url = :shortUrl      
        ';
        $exist = $this->db->query($query,
            ['shortUrl' => $shortUrl],
            true);

        return !is_null($exist['id']);
    }
    private function generateUnicId(): string {
        $chars = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y',
            'Z','0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o',
            'p','q','r','s','t','u','v','w','x','y','z'];
        $unicId = $chars[random_int(0, 61)] .
            $chars[random_int(0, 62)] .
            $chars[random_int(0, 62)] .
            $chars[random_int(0, 62)] .
            $chars[random_int(0, 62)] .
            $chars[random_int(0, 62)] .
            $chars[random_int(0, 62)]
        ;

        return 'go/' . $unicId;
    }
    private function makeTinyUrl(string $sourceUrl): string {

        $shortUrl = $this->getTinyUrl();
        $this->saveUrls($sourceUrl, $shortUrl);

        return $shortUrl;
    }

    private function saveUrls(string $url, string $shortUrl): void {
        $query = '
INSERT INTO ' . $this->urlsTable . '
(url, short_url)
VALUES (:url , :shortUrl)          
        ';

        $this->db->query(
            $query,
            ['url' => $url,
            'shortUrl' => $shortUrl]
        );
    }
}