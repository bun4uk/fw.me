<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 04/10/2016
 * Time: 17:43
 */

error_reporting(-1);

use vendor\core\Router;

require '../vendor/libs/functions.php';

dump($_GET);

define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');


spl_autoload_register(function ($class) {

    $file = ROOT . '/' . str_replace('\\', '/', $class . '.php');

    if (is_file($file)) {
        require_once($file);
    }
});

$query = rtrim($_SERVER['QUERY_STRING'], '/');


Router::add(
    '^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$',
    [
        'controller' => 'Page'
    ]
);
Router::add(
    '^page/(?P<alias>[a-z-]+)$',
    [
        'controller' => 'Page',
        'action' => 'view'
    ]
);

// default rules
Router::add(
    '^$',
    [
        'controller' => 'Main',
        'action' => 'index'
    ]
);

Router::add(
    '^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'
);


//dump(Router::getRoutes());


Router::dispatch($query);

