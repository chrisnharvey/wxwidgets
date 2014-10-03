<?php

namespace Encore\Wx\Element\Traits;

use Encore\Wx\ClosureCallback;

trait Events
{
    /**
     * Bind this elements events to the wxPHP event handler
     * 
     * @return void
     */
    protected function bindEvents()
    {
        $callback = new ClosureCallback(function($method) {
            $controller = $this->collection->getController();
            $args = array_slice(func_get_args(), 1);

            return call_user_func_array([$controller, $method], $args);
        });

        foreach ($this->events as $event => $constant) {
            if ( ! array_key_exists($event, $this->attributes)) continue;

            $this->connectEvent($constant, [$callback, $this->$event]);
        }
    }

    /**
     * Connect the event to the top-level window
     * 
     * @param  integer   $constant
     * @param  callable $callback
     * @return void
     */
    protected function connectEvent($constant, callable $callback)
    {
        $id = $this->element->GetId();

        $this->collection
            ->getTopLevelWindow()
            ->getRaw()
            ->Connect($id, $constant, $callback);
    }
}