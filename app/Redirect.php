<?php

namespace App;

class Redirect
{
    private $db;

    public function __construct()
    {
        $this->db = db::getInstance();
    }

    public function run() {
        $shortUrl = trim(Request::getUrl(), '/');
        $sourceUrl = $this->getFullUrlFromDb($shortUrl);
        $this->makeRedirect($sourceUrl);
    }

    private function makeRedirect (string $sourceUrl) {
        $this->setRedirectsToDb($sourceUrl);
        header("HTTP/1.1 301 Moved Permanently");
        header('Location: ' . $sourceUrl);
        exit();
    }
    

    private function getFullUrlFromDb(string $shortUrl): string {
        $query = '
SELECT url 
FROM urls 
WHERE short_url = :shortUrl      
        ';
         $data = $this->db->query($query,
            ['shortUrl' => $shortUrl],
             true
            );

        return $data['url'];
    }

    private function setRedirectsToDb(string $url): void {
        $query = '
INSERT INTO redirects (`url_id`)
SELECT id
	FROM urls
WHERE url = "' . $url . '"
        ';

        $this->db->query($query,
            ['url' => $url]
        );
    }
}