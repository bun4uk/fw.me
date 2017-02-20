<?php

/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 05/10/2016
 * Time: 15:17
 */

namespace app\Controllers;

use vendor\core\base\Controller;

class Posts extends Controller
{
    public function indexAction()
    {
        echo self::class . ' INDEX It\'s me!';
    }

    public function testAction()
    {
        dump($this->route);
        echo self::class . ' TEST It\'s me!';
    }
}