<?php

namespace Encore\Wx\Element\Traits;

trait Wx
{
    public function getRaw()
    {
        return $this->element;
    }

    public function destroy()
    {
        if (method_exists($this->element, 'Destroy')) {
            $this->element->Destroy();
        }
    }

    public function __call($method, $args)
    {
        if (method_exists($this->element, $method)) {
            return call_user_func_array([$this->element, $method], $args);
        }

        // Trigger an error, the method does not exist
    }
}