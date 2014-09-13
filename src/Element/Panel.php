<?php

namespace Encore\Wx\Element;

use Encore\Giml;

class Panel implements Giml\ElementInterface
{
    use Giml\ElementTrait;
    use Traits\Wx;

    public function __construct()
    {
        
    }

    public function init()
    {
        $this->element = new \wxPanel(null, wxID_ANY, wxDefaultPosition, new \wxSize($this->width, $this->height), wxTAB_TRAVERSAL, $this->title);
    }
}