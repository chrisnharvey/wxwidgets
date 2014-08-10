<?php

namespace Encore\Wx\Element;

class MenuBar implements \Encore\GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;
    use Traits\Wx;

    public function init()
    {
        $this->element = new \wxMenuBar(0);
    }

    public function setParent(\Encore\GIML\ElementInterface $parent)
    {
        $this->parent = $parent; 

        $parent->getRaw()->SetMenuBar($this->element);
    }
}