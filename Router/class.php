<?php
namespace Router;
require_once("routemap.php");

use \Router\Router\Route as Route;

class Router {
    
    private $routeMap;
    private $apiUrl;
    private $request_uri;

    public function __construct($routeMap) {
        $this->routeMap = $routeMap;    
    }

    public function getRoute() {
        $request_uri = explode("?", $_SERVER['REQUEST_URI'], 2);
        $this->MatchRoute($request_uri);
    }

    private function MatchRoute($req_uri) {
        $req_uri = array_values($req_uri)[0];
        if(!empty($req_uri)) { // Check if actually something to search for
            foreach($this->routeMap as $r) {
                $routeArr = explode("/", $r->route); // Explode url to array for easier management
                // Get the last part of call url and check
                // if the last part of route matches a paramter placeholder
                // for example {id} or {name}.
                $end = end($routeArr);
                preg_match('/\{.+\}/', $end, $matches);
                
                // If said parameter url is found, we handle it inside this conditional
                if(count($matches) > 0) {
                    $reqArr = explode("/", $req_uri);
                    // Drop the last part of url
                    // For example /users/id/{id} turns to /users/id
                    // Same way /users/id/1 turns into /users/id
                    $slicedRequest = implode("/", array_slice($reqArr, 0, -1));
                    $slicedRoute = implode("/", array_slice($routeArr, 0, -1));
                    // Place the parameter from the end of url into a variable
                    $param = end(explode("/", $req_uri));
                    // Check newly generated api urls without the parameters
                    if($slicedRequest == $slicedRoute) {
                        header('Content-Type: application/json');
                        return $r->Handle($param);
                    }
                }
                // If url didn't have parameter, just call Handler wihout a parameter
                if($r->route == $req_uri) {
                    header('Content-Type: application/json');
                    return $r->Handle();
                }
            }
            echo "Couldn't find endpoint";
            return false;
        } else {
            echo "Please give a url";
            return false;
        }
    }
}