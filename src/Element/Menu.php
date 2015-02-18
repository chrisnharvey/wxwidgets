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

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $this->element = new wxMenu;

        $rawParent = $this->parent->getRaw();

        if ($rawParent instanceof wxMenuBar or $rawParent instanceof wxMenu) {
            $rawParent->Append($this->element, $this->title);
        }
    }
}