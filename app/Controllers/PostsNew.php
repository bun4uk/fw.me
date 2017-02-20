<?php

/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 05/10/2016
 * Time: 15:49
 */

namespace app\Controllers;

class PostsNew
{

    /**
     *
     */
    public function indexAction()
    {
        echo $this->getMethodName(__FUNCTION__);
    }

    /**
     *
     */
    public function testAction()
    {
        echo $this->getMethodName(__FUNCTION__);
    }

    /**
     *
     */
    public function testPageAction()
    {
        echo $this->getMethodName(__FUNCTION__);
    }

    public function before()
    {
        echo $this->getMethodName(__FUNCTION__);
    }

    /**
     * @param string $methodName
     * @return string
     */
    private function getMethodName(string $methodName) :string
    {
        return self::class . '::' . $methodName . '()';
    }

}