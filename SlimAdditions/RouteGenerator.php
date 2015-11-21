<?php

namespace SlimAdditions;

class RouteGenerator
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    private function permissions($controller_name, $method)
    {
        return '\\App\\Permissions\\' . $controller_name . ':check';
    }

    private function request($controller_name, $method)
    {
        return '\\App\\Controllers\\' . $controller_name . ":" . $method;
    }

    private function route($http_method, $url, $controller, $action)
    {
        return $this->app->$http_method($url, $this->request($controller, $action))->add($this->permissions($controller, $action));
    }

    public function loadRoutes($path = "config/routes.php")
    {
        include $path;
    }
}
