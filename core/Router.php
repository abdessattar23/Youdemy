<?php

class Router {
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function add($method, $route, $controller) {
        $method = strtoupper($method);
        $route = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^/]+)', $route);

        $this->routes[$method][$route] = $controller;
    }

    public function run($method, $url){
        $path = parse_url($url, PHP_URL_PATH);
        $method = strtoupper($method);
        foreach ($this->routes[$method] as $route => $controller) {
            if (preg_match_all('#^'.str_replace('/','\/', $route).'$#', $path, $matches)) {
                array_shift($matches);
                if (is_array($controller)) {
                    $controller = new $controller[0]();
                    $method = $controller[1];
                    return call_user_func_array([$controller, $method], $matches);
                }
                return call_user_func_array($controller, $matches);
            }
        }
        http_response_code(404);
        echo "Requested route/resource not found.";
    }

}