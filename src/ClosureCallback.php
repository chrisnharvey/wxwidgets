<?php

namespace Encore\Wx;

use Closure;

class ClosureCallback
{
    protected $closure;

    public function __construct(Closure $closure)
    {
        $this->closure = $closure;
    }

    public function __call($method, $args)
    {
        array_unshift($args, $method);

        return call_user_func_array($this->closure, $args);
    }
}
