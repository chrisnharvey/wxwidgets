<?php

namespace Encore\Wx;

use Closure;

class ClosureCallback
{
    protected $closure;

    /**
     * Construct the closure callback with an injected closure
     * 
     * @param Closure $closure
     */
    public function __construct(Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     * Call the closure with the called method as the first argument
     * 
     * @param  string $method
     * @param  array $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        array_unshift($args, $method);

        return call_user_func_array($this->closure, $args);
    }
}
