<?php

namespace Encore\Wx\Element\Traits;

trait Wx
{
    /**
     * Get the raw wxPHP object
     * 
     * @return mixed
     */
    public function getRaw()
    {
        return $this->element;
    }

    /**
     * Destroy the element
     * 
     * @return void
     */
    public function destroy()
    {
        if (method_exists($this->element, 'Destroy')) {
            $this->element->Destroy();
        }
    }

    /**
     * Forward undefined methods to the wxPHP object
     * 
     * @param  string $method
     * @param  array $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        if (method_exists($this->element, $method)) {
            return call_user_func_array([$this->element, $method], $args);
        }

        // Trigger an error, the method does not exist
    }
}