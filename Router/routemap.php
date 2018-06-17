<?php
require __DIR__ . "/../vendor/autoload.php";
use \Router\Route as Route;
// Map routes with the scheme [URL, METHOD]
$routemap = [
    new Route("/api/users/all", "GET"),
    new Route("/api/users/id/{id}", "GET")  
];