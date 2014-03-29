<?php

namespace Encore\Wx\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Install extends \Encore\Console\Command
{
    public $name = 'wxwidgets:install';
    public $description = 'Install wxWidgets and wxPHP';

    public function fire()
    {
        $handle = popen(PHP_BINDIR.'/pecl install wxwidgets 2>&1', 'r');

        while ( ! feof($handle)) { 
            $this->output->write(fread($handle, 2048));
        }
    }
}