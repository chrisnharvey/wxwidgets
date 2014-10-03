<?php

namespace Encore\Wx\Element\Traits;

use wxSize;

trait Sizable
{
    /**
     * Create a wxSize object from the width/height
     * 
     * @return wxSize
     */
    protected function getSize()
    {
        if ($this->width and $this->height) {
            return new wxSize($this->width, $this->height);
        }

        return wxDefaultSize;
    }
}