<?php
/**
 * The startup file. Initialises and runs the Slim application (along with the SlimAdditions pieces)
 *
 * This file goes in your config directory at the root of your application, or just straight in the index.php file in your public directory.
 */
date_default_timezone_set('UTC');

define("DOC_ROOT", dirname(dirname(__FILE__)));
set_include_path(get_include_path() . PATH_SEPARATOR . DOC_ROOT);

require 'config/config.php';

$loader = require 'vendor/autoload.php';
$loader->add('App', DOC_ROOT);

$app = new \Slim\App();

$route_gen = new \SlimAdditions\RouteGenerator($app);
$route_gen->loadRoutes();

$app->run();
