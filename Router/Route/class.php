<?php
namespace Router;

class Route {

    public $route;
    public $method;

    private $Handlers;

    public function __construct($route, $method) {
        $this->route = $route;
        $this->method = $method;
        $this->Handlers = "/Handlers/";
    }

    public function Handle($param = null) {
        $this->GetApiUrl();
        // Get callable class from url
        $class = ucfirst(array_shift($this->route));
        // Get callable function from url
        $function = ucfirst(array_shift($this->route));

        // Go to root level and find Handler's index.
        require(__DIR__ . "/../.." . $this->Handlers . $class . "/index.php");

        $handler = new $class();

        // If provided parameter, the function should start with "getBy"
        // For example Users/getById();
        if($param != null) {
            $function = "getBy" . $function;
            $handler->$function($param);
        } else {
            $handler->$function();
        }
    }

    private function GetApiUrl() {
        // Drop sections from url until it matches the Handler folder scheme
        $uri = explode("/", $this->route);
        $this->route = $uri;
        while(reset($this->route) != "api") {
            $this->Drop();
        }
        $this->Drop();
    }

    private function Drop() {
        // Unset the first part of array
        unset($this->route[key($this->route)]);
    }
}