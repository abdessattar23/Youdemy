<?php
require_once __DIR__ . '/../autoload.php';
class Router extends BaseController{
    private $routes = [
        'GET' => [],
        'POST' => [],
        'DELETE' => []
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
                    $controllerClass = $controller[0];
                    $methodName = $controller[1];
                    $controllerInstance = new $controllerClass();
                    return call_user_func_array([$controllerInstance, $methodName], array_map('array_shift', $matches));
                }
                return call_user_func_array($controller, $matches);
            }
        }
        http_response_code(404);
        $this->render('components/404');
    }

}