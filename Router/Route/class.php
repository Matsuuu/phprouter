<?php

class Route {

    public $route;
    public $method;

    private $Handlers;

    public function __construct($route, $method) {
        $this->route = $route;
        $this->method = $method;
        $this->Handlers = "/Handlers/";
    }

    public function Handle() {

        $this->GetApiUrl();
        $class = ucfirst(array_shift($this->route));
        $function = ucfirst(array_shift($this->route));

        require(__DIR__ . "/../../" . $this->Handlers . $class . ".php");

        $handler = new $class();

        $handler->$function();
    }

    private function GetApiUrl() {
        $uri = explode("/", $this->route);
        $this->route = $uri;
        while(reset($this->route) != "api") {
            $this->Drop();
        }
        $this->Drop();
    }

    private function Drop() {
        unset($this->route[key($this->route)]);
    }
}