<?php

namespace Encore\Wx;

use Encore\Container\ContainerAwareInterface;
use Encore\Container\ContainerAwareTrait;

class Widgets extends \wxApp implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function OnInit()
    {
        $this->container->launch();
    }

    public function OnExit()
    {
        $this->container->quit();
    }
}
