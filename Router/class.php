<?php

class Router {
    
    private $routeMap;
    private $apiUrl;
    private $request_uri;

    public function __construct($routeMap) {
        $this->routeMap = $routeMap;    
    }

    public function getRoute($request_uri) {
        $this->MatchRoute($request_uri);
    }

    private function MatchRoute($req_uri) {
        $req_uri = array_values($req_uri)[0];
        if(!empty($req_uri)) {
            foreach($this->routeMap as $r) {
                if($r->route == $req_uri) {
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