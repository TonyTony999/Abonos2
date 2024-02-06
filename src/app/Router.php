<?php

declare(strict_types=1);

namespace App;

use Exception;

class Router
{

    protected array $routes = [];

    public function register(string $requestMethod, string $route, array | callable $action): void
    {
        $this->routes[$requestMethod][$route]= $action;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function resolve(string $requestMethod, string $requestURI)
    {

        $route = explode('?', $requestURI)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new Exception();
        }

        if (is_callable($action)) {
            echo "its callable";
            return call_user_func($action);
        }
        if (is_array($action)) {

            [$class, $method] = $action;

            if (class_exists($class)) {
                $class = new $class;

                if (method_exists($class, $method)) {
                    return call_user_func([$class, $method], []);
                }
            }
        }
    }
}
