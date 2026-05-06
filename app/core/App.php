<?php
class App
{
    private $route = [];
    private $requestPath = '';

    public function __construct()
    {
        $this->loadRoutes();
        $this->parseUrl();
        $this->dispatch();
    }

    private function loadRoutes()
    {
        require_once APP_PATH . '/router/routes.php';
        $this->route = $route ?? [];
    }

    private function parseUrl()
    {
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '';
        $requestPath = trim(str_replace('\\', '/', $requestPath), '/');
        $scriptDir = trim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

        if ($scriptDir !== '' && str_starts_with($requestPath, $scriptDir)) {
            $requestPath = trim(substr($requestPath, strlen($scriptDir)), '/');
        }

        $this->requestPath = $requestPath;
    }

    private function dispatch()
    {
        $controllerInfo = $this->route[$this->requestPath] ?? ($this->requestPath === '' ? ($this->route[''] ?? null) : null);

        if ($controllerInfo === null) {
            header('HTTP/1.0 404 Not Found');
            echo '404 Not Found';
            exit;
        }

        $class = $controllerInfo[0];
        $method = $controllerInfo[1];

        $this->loadController($class);
        $controller = new $class();
        $controller->$method();
    }

    private function loadController($class)
    {
        $controllerFileCandidates = [
            APP_PATH . '/controllers/' . $class . '.php',
            APP_PATH . '/controllers/' . lcfirst($class) . '.php',
            APP_PATH . '/controllers/' . strtolower($class) . '.php',
        ];

        foreach ($controllerFileCandidates as $controllerFile) {
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                return;
            }
        }

        header('HTTP/1.0 404 Not Found');
        echo 'Controller not found: ' . htmlspecialchars($class);
        exit;
    }
}
