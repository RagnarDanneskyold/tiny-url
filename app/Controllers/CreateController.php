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
        $sourceUrl = self::getInput();
        $shortUrl = $this->makeTinyUrl($sourceUrl);

        self::json($shortUrl);
    }

    public function getUrlsList() {
        session_start();
        if (self::sessionGet('auth') === 'true'){
            if (empty($_GET)) {
                $allUrlsArray = $this->getAllUrlArray();
            } elseif (isset($_GET['filter'])) {
                $allUrlsArray = $this->getAllUrlArray($_GET['filter'], $_GET['value']);
            }

            return self::json($allUrlsArray);
        }

        return self::json('нет доступа');
    }

    private function getAllUrlArray(string $field = null, string $value = null) {
        $query = 'SELECT * FROM ' . $this->urlsTable;
        if (isset($field) && isset($value)) {
            $query .= '
WHERE ' . $field . ' LIKE "%' . $value . '%"
            ';
        }

        return $this->db->query($query);
    }

    public function updateUrl() {
        $input = self::getInput();
        $urlData = json_decode(json_encode($input), TRUE);
        $query = '
UPDATE ' . $this->urlsTable . '
SET url = :url , short_url = :short_url
WHERE id = :id        
      ';

      return $this->db->query(
          $query,
          [
              'url' => $urlData['url'],
              'short_url' => $urlData['short_url'],
              'id' => $urlData['id']
          ]
      );

    }

    public function deleteUrl() {
        $input = self::getInput();
        $urlData = json_decode(json_encode($input), TRUE);

        return $this->db->query('DELETE FROM ' . $this->urlsTable . ' WHERE id = ' . (int)$urlData['id']);
    }

    private function getTinyUrl(): string {
        $shortUrl = $this->generateUnicId();

        if ($this->isExistShortUrl($shortUrl)) {

            return  $this->getTinyUrl();
        }

        return $shortUrl;
    }

    private function isExistShortUrl(string $shortUrl): bool {
        $query = '
SELECT id FROM ' . $this->urlsTable . ' WHERE short_url = :shortUrl      
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