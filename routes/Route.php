<?php
namespace App\Routes;

use App\Providers\View;

class Route {

    private static $routes = [];

    // Register a GET route
    static public function get(string $url, string $controller): void {
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'GET'];
    }

    // Register a POST route
    static public function post(string $url, string $controller): void {
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'POST'];
    }

    // Call the controller action matching the current URL and method
    static public function dispatch(){
        $url = $_SERVER['REQUEST_URI'];
        $urlSegments = explode('?', $url);
        $urlPath = $urlSegments[0];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach(self::$routes as $route){
            if(BASE . $route['url'] == $urlPath && $route['method'] == $method){
                $controllerSegments = explode('@', $route['controller']);
                $controllerName = 'App\\Controllers\\' . $controllerSegments[0];
                $methodName = $controllerSegments[1];

                $controllerInstance = new $controllerName();

                if($method == "GET"){
                    if(isset($urlSegments[1])){
                        parse_str($urlSegments[1], $queryParams);
                        $controllerInstance->$methodName($queryParams);
                    }else{
                        $controllerInstance->$methodName();
                    }
                }elseif($method == "POST"){
                    if(isset($urlSegments[1])){
                        parse_str($urlSegments[1], $queryParams);
                        $controllerInstance->$methodName($_POST, $queryParams);
                    }else{
                        $controllerInstance->$methodName($_POST);
                    }
                }
                return;
            }
        }

        http_response_code(404);
        View::render('error', ['message' => 'Page not found.']);
    }
}