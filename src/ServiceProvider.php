<?php

namespace Encore\Wx;

use Illuminate\Filesystem\Filesystem;
use Encore\Wx\Command\Install as InstallCommand;
use Encore\View\Parser\View\Giml as ViewParser;
use Encore\Giml\NamespaceElementFactory;

class ServiceProvider extends \Encore\Container\ServiceProvider
{
    public function register($binding)
    {
        if ( ! extension_loaded('wxwidgets')) {
            if ( ! @dl('wxwidgets.'.PHP_SHLIB_SUFFIX)) {
                echo 'wxWidgets extension required'.PHP_EOL;
                exit(1);
            }
        }

        switch ($binding) {
            case 'view.viewparser':
                $this->registerViewParser();
            break;

            case 'wx':
                $this->registerWx();
            break;

            case 'launcher':
                $this->registerLauncher();
            break;

            default: 
                $this->registerGimlCollection();
                $this->registerViewParser();
                $this->registerWx();
                $this->registerLauncher();
            break;
        }
    }

    protected function registerViewParser()
    {
        $this->container->bind('view.viewparser', new ViewParser(
            $this->container['giml.reader'],
            $this->container['giml.collection'],
            new NamespaceElementFactory('Encore\Wx\Element')
        ));
    }

    protected function registerGimlCollection()
    {
        $this->container['giml.collection'] = new Collection;
    }

    protected function registerWx()
    {
        $this->container->bind('wx', new Widgets);
    }

    protected function registerLauncher()
    {
        $this->container->bind('launcher', function() {
            wxInitAllImageHandlers();
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
        return ['wx', 'launcher', 'view.viewparser', 'giml.collection'];
    }
}