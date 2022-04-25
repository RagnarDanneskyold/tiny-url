<?php

namespace App;

class App
{
    public function init() {
        $router = new Router();
        $router->handle();
    }
}