<?php

namespace Encore\Wx\Element\Traits;

trait Wx
{
    public function getRaw()
    {
        return $this->element;
    }

    public function __destruct()
    {
        if (method_exists($this->element, 'Destroy')) {
            $this->element->Destroy();
        }
    }
}