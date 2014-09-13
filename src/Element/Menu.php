<?php

namespace Encore\Wx\Element;

class Menu implements \Encore\Giml\ElementInterface
{
    use \Encore\Giml\ElementTrait;
    use Traits\Wx;

    public function setParent(\Encore\Giml\ElementInterface $parent)
    {
        $this->parent = $parent;

        $this->element = new \wxMenu;

        $parent->getRaw()->Append($this->element, $this->title);
    }
}