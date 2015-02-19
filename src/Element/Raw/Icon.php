<?php

namespace Encore\Wx\Element\Raw;

use wxIcon;
use Encore\Giml\ElementInterface;

class Icon extends wxIcon
{
    public function __construct($path, $type = null)
    {
        parent::__construct($path, $type ?: $this->guessType($path));
    }

    protected function guessType()
    {
        return wxBITMAP_TYPE_PNG;
    }
}