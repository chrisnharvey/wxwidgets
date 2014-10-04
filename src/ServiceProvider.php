<?php

namespace Encore\Wx;

use Illuminate\Filesystem\Filesystem;
use Encore\Wx\Command\Install as InstallCommand;
use Encore\View\Parser\View\Giml as ViewParser;
use Encore\Giml\NamespaceElementFactory;

class ServiceProvider extends \Encore\Container\ServiceProvider
{
    /**
     * Register the specified binding into the container
     * 
     * @param  string $binding
     * @return void
     */
    public function register($binding)
    {
        if ( ! extension_loaded('wxwidgets')) {
            if ( ! @dl('wxwidgets.'.PHP_SHLIB_SUFFIX)) {
                echo 'wxWidgets extension not installed or dynamically loaded extensions are not enabled'.PHP_EOL;
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

            case 'giml.collection':
                $this->registerGimlCollection();
            break;

            default: 
                $this->registerGimlCollection();
                $this->registerViewParser();
                $this->registerWx();
                $this->registerLauncher();
            break;
        }
    }

    /**
     * Register the view parser
     * 
     * @return void
     */
    protected function registerViewParser()
    {
        $this->container->bind('view.viewparser', function() {
            return new ViewParser(
                $this->container['giml.reader'],
                $this->container['giml.collection'],
                new NamespaceElementFactory('Encore\Wx\Element')
            );
        });
    }

    /**
     * Register the GIML collection
     * 
     * @return void
     */
    protected function registerGimlCollection()
    {
        $this->container['giml.collection'] = 'Encore\Wx\Collection';
    }

    /**
     * Register WxWidgets app handler
     * 
     * @return void
     */
    protected function registerWx()
    {
        $this->container->bind('wx', new Widgets);
    }

    /**
     * Register the WxWidgets launcher
     * 
     * @return void
     */
    protected function registerLauncher()
    {
        $this->container->bind('launcher', function() {
            wxInitAllImageHandlers();
            \wxApp::SetInstance($this->container['wx']);
            wxEntry();
        });
    }

    /**
     * Register the WxWidgets install command
     * 
     * @return array
     */
    public function commands()
    {
        return ['Encore\Wx\Command\Install'];
    }

    /**
     * Set which services this provider provides
     * 
     * @return array
     */
    public function provides()
    {
        return ['wx', 'launcher', 'view.viewparser', 'giml.collection'];
    }
}