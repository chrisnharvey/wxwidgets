<?php

namespace Encore\Wx\Element\Traits;

use Encore\Wx\ClosureCallback;

trait Events
{
    protected function bindEvents()
    {
        $id = $this->collection->getTrueId($this->id);

        foreach ($this->events as $event => $constant) {
            if ( ! array_key_exists($event, $this->attributes)) continue;

            $this->element->Connect($id, $constant, [$this, $event]);
        }
    }

    public function __call($method, $args)
    {
        $controller = $this->collection->getController();

        return call_user_func_array([$controller, $this->$method], []);
    }
}