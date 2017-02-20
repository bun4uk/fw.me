<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 21/10/2016
 * Time: 12:01
 */

namespace app\Controllers;


use vendor\core\base\Controller;

class Page extends Controller
{

    public function viewAction()
    {
        dump($this->route);
        dump($_GET);
        echo 'Page::view()';
    }

}