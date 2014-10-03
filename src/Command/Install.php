<?php

namespace Encore\Wx\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Install extends \Encore\Console\Command
{
    protected $name = 'wxwidgets:install';
    protected $description = 'Install wxWidgets and wxPHP';

    /**
     * Fire the install command
     * 
     * @return void
     */
    public function fire()
    {
        $handle = popen(PHP_BINDIR.'/pecl install wxwidgets 2>&1', 'r');

        while ( ! feof($handle)) { 
            $this->output->write(fread($handle, 2048));
        }
    }

    /**
     * Get a list of options that this command takes
     * 
     * @return array
     */
    public function getOptions()
    {
        return [
            ['from-source', null, InputOption::VALUE_NONE, 'Download wxPHP from source instead of installing from PECL'],
        ];
    }
}