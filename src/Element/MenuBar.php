<?php

namespace Encore\Wx\Element;

use wxMenuBar;
use Encore\Giml\ElementTrait;
use Encore\Wx\Element\Traits\Wx;
use Encore\Giml\ElementInterface;

class MenuBar implements ElementInterface
{
    use ElementTrait;
    use Wx;

    public function init()
    {
        $this->element = new wxMenuBar(0);
    }

    public function setParent(ElementInterface $parent)
    {
        $this->parent = $parent; 

        $parent->getRaw()->SetMenuBar($this->element);
    }
}