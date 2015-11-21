<?php
/**
 * Routes are now all defined using the "route" method, regardless of method used to access the route.
 *
 * By default this file goes in the config/ directory in the root of your codebase.
 *
 * The params are as follows:
 *
 * @param string $http_method - The method used to define the route. get | post | put | patch | options etc..
 * @param string $url - The path
 * @param string $controller - The class name of the controller
 * @param string $action - The method to call within the controller class
 */
$this->route("get", "/path/", "MyControllerClass", "myMethod");
