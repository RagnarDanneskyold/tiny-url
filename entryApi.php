<?php
use App\App;

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/vendor/autoload.php');

$app = new App();
$app->init();
