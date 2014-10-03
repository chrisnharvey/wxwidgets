<?php

namespace Encore\Wx\Element\Traits;

use wxPoint;

trait Positionable
{
    /**
     * Create a new wxPoint object from the x/y position
     * 
     * @return wxPoint
     */
    protected function getPosition()
    {
        if ($this->x and $this->y) {
            return new wxPoint($this->x, $this->y);
        }

        return wxDefaultPosition;
    }
}