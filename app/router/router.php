<?php
class Router {
    protected $routes = [];

    public function get($uri, $action) {
        $this->routes[$uri] = $action;
    }

    public function handle($uri, $orderIdForPage) {
        if (array_key_exists($uri, $this->routes)) {
            $action = $this->routes[$uri];
            $this->callAction($action, $orderIdForPage);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo '404 Not Found';
        }
    }

    protected function callAction($action, $orderIdForPage) {
        list($controller, $method) = explode('@', $action);
        require_once "controller/user/{$controller}.php";
        $controller = new $controller($orderIdForPage);
        $controller->$method();
    }
}
?>