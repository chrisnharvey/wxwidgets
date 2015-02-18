<?php

namespace Encore\Wx\Element\Raw;

use wxMenu;
use Encore\Giml\ElementInterface;

class TaskBarIcon extends \wxTaskBarIcon
{
    protected $menu;

    public function setMenu(ElementInterface $menu)
    {
        $this->menu = $menu;
    }

    public function CreatePopupMenu()
    {
        if ( ! isset($this->menu)) return new wxMenu;

        return $this->menu->getRaw();
    }
}