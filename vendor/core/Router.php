<?php

/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 04/10/2016
 * Time: 17:57
 */

namespace vendor\core;

/**
 * Class Router
 */
class Router
{
    /**
     * @var array
     */
    protected static $routes = [];

    /**
     * @var
     */
    protected static $route;

    /**
     * @param $regexp
     * @param array $route
     */
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * @return mixed
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * @param $url
     * @return bool
     */
    private static function matchRoutes($url) : bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                dump($route);
                return true;
            }
        }
        return false;
    }

    /**
     * Route url
     * @param string $url
     */
    public static function dispatch(string $url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoutes($url)) {
            $controller = 'app\Controllers\\' . self::$route['controller'];
            if (class_exists(($controller))) {
                $controllerObject = new $controller(self::$route);
            } else {
                dump("Controller <b>$controller</b> doesn't exists");
                exit;
            }

            $action = self::lowerCamelCase(self::$route['action']) . 'Action';
            if (method_exists($controllerObject, $action)) {
                $controllerObject->$action();
            } else {
                dump("Method <b>$controller::$action()</b> doesn't exists");
            }
        } else {
            http_response_code(404);
            include "404.html";
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    protected static function upperCamelCase($name)
    {
        return $name = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * @param $name
     * @return string
     */
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    protected static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url, 2);

            if (false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }

        return $url;
    }
}