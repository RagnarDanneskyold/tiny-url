<?php
use App\Redirect;

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/vendor/autoload.php');

$redirect = new Redirect();
$redirect->run();
