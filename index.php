<?php
namespace API;
require_once(__DIR__ . "/vendor/autoload.php");
require_once("./Router/routemap.php");
use \Router\Router as Router;

$router = new Router($routemap);

$router->getRoute();