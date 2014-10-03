<?php

namespace Encore\Wx\Element\Traits;

use wxPoint;

trait Positionable
{
    protected function getPosition()
    {
        if ($this->x and $this->y) {
            return new wxPoint($this->x, $this->y);
        }

        return wxDefaultPosition;
    }
}