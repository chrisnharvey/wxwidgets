<?php

namespace Encore\Wx\Element;

class Menu implements \Encore\GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;
    use Traits\Wx;

    public function setParent(\Encore\GIML\ElementInterface $parent)
    {
        $this->parent = $parent;

        $this->element = new \wxMenu;

        $parent->getRaw()->Append($this->element, $this->title);
    }
}