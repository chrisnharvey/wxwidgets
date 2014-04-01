<?php

namespace Encore\Wx;

use Illuminate\Filesystem\Filesystem;
use Encore\Wx\Command\Install as InstallCommand;

class ServiceProvider extends \Encore\Container\ServiceProvider
{
    public function register($binding)
    {
        if ( ! extension_loaded('wxwidgets')) {
            dl('wxwidgets.'.PHP_SHLIB_SUFFIX);
        }

        switch ($binding) {
            case 'view.engine':
                $this->registerViewEngine();
            break;

            case 'wx':
                $this->registerWx();
            break;

            case 'launcher':
                $this->registerLauncher();
            break;

            default: 
                $this->registerViewEngine();
                $this->registerWx();
                $this->registerLauncher();
            break;
        }
    }

    protected function registerViewEngine()
    {
        $this->container->bind('view.engine', function() {
            $finder = new FileResourceFinder(new Filesystem, $this->app['config']['view.paths']);

            return new Manager($finder);
        });
    }

    protected function registerWx()
    {
        $this->container->bind('wx', new Widgets);
    }

    protected function registerLauncher()
    {
        $this->container->bind('launcher', function() {
            \wxApp::SetInstance($this->container['wx']);
            wxEntry();
        });
    }

    public function commands()
    {
        return ['Encore\Wx\Command\Install'];
    }

    public function provides()
    {
        return ['wx', 'launcher', 'view.engine', 'giml.collection'];
    }
}