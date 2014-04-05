<?php

namespace Encore\Wx;

use Encore\Container\Container;
use Encore\Container\ContainerAwareInterface;

class Widgets extends \wxApp implements ContainerAwareInterface
{
    protected static $container;

    public function setContainer(Container $container)
    {
        static::$container = $container;
    }

    public function getContainer()
    {
        return static::$container;
    }

    public function OnInit()
    {
        $this->getContainer()->launch();
    }

    public function OnExit()
    {
        $this->getContainer()->quit();
    }
}
