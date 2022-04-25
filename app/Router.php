<?php

namespace App;


class Router
{
    private $routes = [];

    private $routesPath = ROOT . '/app/routes.php';

    private $method;

    public function __construct()
    {
        $this->routes = require_once($this->routesPath);
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function handle() {
        $url = $this->getURL();
        $routeHandler = $this->resolveRoute($url);
        if ($routeHandler === null) {
            exit('Не найден данный маршрут');
        };
        $instance = new $routeHandler[0]();
        call_user_func_array(array($instance, $routeHandler[1]), []);
    }

    private function getURL()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = trim($_SERVER['REQUEST_URI'], '/');
            return explode('?', $uri, 2)[0];
        }
    }

    private function resolveRoute($url) {
        $routeMethods = array_filter($this->routes, function ($key) use ($url) {
            return $key === $url;
        }, ARRAY_FILTER_USE_KEY);

        if(empty($routeMethods[$url])) {
            return null;
        }

        $routeData = reset(array_filter($routeMethods[$url], function ($method) {
            return $method['method'] === $this->method;
        }));

        return $routeData['handler'];
    }
}