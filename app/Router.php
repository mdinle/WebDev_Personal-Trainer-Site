<?php
namespace App;

class Router
{
    private $routes = [];
    public function add($route, $controller, $action)
    {
        $this->routes[$route] = ['controller' => $controller,
        'action' => $action];
    }
    public function route($url)
    {
        if (array_key_exists($url, $this->routes)) {
            $controller = $this->routes[$url]['controller'];
            $action = $this->routes[$url]['action'];
            $controllerObject = new $controller;
            $controllerObject->$action();
        } else {
            echo '404 Not Found';
        }
    }
}
