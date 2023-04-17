<?php

class Routing
{
    private array $routes = [];

    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public function addRoute($path, $callback)
    {
        $this->routes[] = new Route($path, $callback);
    }

    /**
     * @return void
     */
    public function run()
    {
        $url = $_SERVER['PATH_INFO'] ?? '/';
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        foreach ($this->routes as $route) {
            if ($route->match($url)) {
                return $route->run();
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
    }
}