<?php

namespace Encore\Wx;

use Encore\Container\Container;
use Encore\Container\ContainerAwareInterface;

class Widgets extends \wxApp implements ContainerAwareInterface
{
    protected static $container;

    /**
     * Set the container.
     *
     * @param   Container $container
     * @return  void
     */
    public function setContainer(Container $container)
    {
        static::$container = $container;
    }

    /**
     * Get the container.
     *
     * @return Container
     */
    public function getContainer()
    {
        return static::$container;
    }

    /**
     * Called when the application is initialised
     */
    public function OnInit()
    {
        $this->getContainer()->launch();
    }

    /**
     * Called when the application exits
     */
    public function OnExit()
    {
        $this->getContainer()->quit();

        exit(0);
    }
}
