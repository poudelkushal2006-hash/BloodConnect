<?php
// app/core/Router.php

class Router {
    private $routes = [];

    public function get($uri, $controllerAction) {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    public function post($uri, $controllerAction) {
        $this->routes['POST'][$uri] = $controllerAction;
    }

    public function dispatch($requestUri, $requestMethod) {
        // Remove query string from URI
        $uri = parse_url($requestUri, PHP_URL_PATH);
        
        // Adjust for subfolder if necessary
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptName !== '/' && $scriptName !== '\\') {
            $uri = str_replace($scriptName, '', $uri);
        }
        $uri = $uri === '' ? '/' : $uri;

        if (isset($this->routes[$requestMethod][$uri])) {
            $controllerAction = $this->routes[$requestMethod][$uri];
            list($controller, $action) = explode('@', $controllerAction);

            require_once __DIR__ . "/../controllers/{$controller}.php";
            $controllerInstance = new $controller();
            $controllerInstance->$action();
        } else {
            http_response_code(404);
            echo "404 Not Found - BloodConnect";
        }
    }
}
