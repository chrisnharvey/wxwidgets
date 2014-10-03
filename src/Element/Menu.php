<?php

namespace Encore\Wx\Element;

use wxMenu;
use Encore\Giml\ElementTrait;
use Encore\Giml\ElementInterface;
use Encore\Wx\Element\Traits\Wx;

class Menu implements ElementInterface
{
    use ElementTrait;
    use Wx;

    public function init()
    {
        $this->element = new \wxMenu;

        $this->parent->getRaw()->Append($this->element, $this->title);
    }
}