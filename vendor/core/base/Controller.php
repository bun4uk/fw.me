<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 21/10/2016
 * Time: 11:30
 */

namespace vendor\core\base;


abstract class Controller
{
    public $route = [];

    public $view;

    public function __construct($route)
    {
        $this->route = $route;
//        $this->view = $route['action'];
//        include APP . "/views/{$this->route['controller']}/{$this->view}.php";
    }
}