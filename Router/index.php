<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("./class.php");
require("./Route/class.php");

$request_uri = explode("?", $_SERVER['REQUEST_URI'], 2);

$router = new Router(
    [
        new Route("/api/users/all", "GET"),
        new Route("/api/users/id", "GET")
    ]
);

$router->getRoute($request_uri);    


?>