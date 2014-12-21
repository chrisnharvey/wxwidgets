<?php

namespace Encore\Wx\Element;

use wxTaskBarIcon;
use Encore\Giml\ElementTrait;
use Encore\Wx\Element\Traits\Wx;
use Encore\Giml\ElementInterface;

class TaskBarIcon implements ElementInterface
{
    use ElementTrait;
    use Wx;

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $this->element = new wxTaskBarIcon;
    }
}