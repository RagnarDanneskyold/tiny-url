<?php

namespace App;

class Redirect
{
    private $db;
    private $url;

    public function __construct()
    {
        $this->db = db::getInstance();
    }

    public function run() {
        $shortUrl = trim($this->getUrl(), '/');
        $sourceUrl = $this->getFullUrlFromDb($shortUrl);
        $this->makeRedirect($sourceUrl);
    }

    private function makeRedirect (string $sourceUrl) {
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

    /**
     * Returns the currently requested relative URL.
     * This refers to the portion of the URL that is after the [[hostInfo]] part.
     * It includes the [[queryString]] part if any.
     * @return string the currently requested relative URL. Note that the URI returned is URL-encoded.
     */
    public function getUrl()
    {
        if ($this->url === null) {
            $this->url = $this->resolveRequestUri();
        }

        return $this->url;
    }

    /**
     * Resolves the request URI portion for the currently requested URL.
     * This refers to the portion that is after the [[hostInfo]] part. It includes the [[queryString]] part if any.
     * The implementation of this method referenced Zend_Controller_Request_Http in Zend Framework.
     * @return string|boolean the request URI portion for the currently requested URL.
     * Note that the URI returned is URL-encoded.
     * @throws InvalidConfigException if the request URI cannot be determined due to unusual server configuration
     */
    protected function resolveRequestUri()
    {
        if (isset($_SERVER['HTTP_X_REWRITE_URL'])) { // IIS
            $requestUri = $_SERVER['HTTP_X_REWRITE_URL'];
        } elseif (isset($_SERVER['REQUEST_URI'])) {
            $requestUri = $_SERVER['REQUEST_URI'];
            if ($requestUri !== '' && $requestUri[0] !== '/') {
                $requestUri = preg_replace('/^(http|https):\/\/[^\/]+/i', '', $requestUri);
            }
        } elseif (isset($_SERVER['ORIG_PATH_INFO'])) { // IIS 5.0 CGI
            $requestUri = $_SERVER['ORIG_PATH_INFO'];
            if (!empty($_SERVER['QUERY_STRING'])) {
                $requestUri .= '?' . $_SERVER['QUERY_STRING'];
            }
        } else {
            die('Unable to determine the request URI.');
        }

        return $requestUri;
    }
}