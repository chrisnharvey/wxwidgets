<?php

namespace Encore\Wx\Element;

class MenuBar implements \Encore\Giml\ElementInterface
{
    use \Encore\Giml\ElementTrait;
    use Traits\Wx;

    public function init()
    {
        $this->element = new \wxMenuBar(0);
    }

    public function setParent(\Encore\Giml\ElementInterface $parent)
    {
        $this->parent = $parent; 

        $parent->getRaw()->SetMenuBar($this->element);
    }
}