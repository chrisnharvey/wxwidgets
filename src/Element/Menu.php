<?php

namespace Encore\Wx\Element;

class Menu implements \Encore\Giml\ElementInterface
{
    use \Encore\Giml\ElementTrait;
    use Traits\Wx;

    public function init()
    {
        $this->element = new \wxMenu;

        $this->parent->getRaw()->Append($this->element, $this->title);
    }
}