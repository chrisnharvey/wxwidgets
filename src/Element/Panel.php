<?php

namespace Encore\Wx\Element;

use Encore\GIML;

class Panel implements GIML\ElementInterface
{
    use GIML\ElementTrait;

    public function __construct()
    {
        
    }

    public function init()
    {
        $this->element = new \wxPanel(null, wxID_ANY, wxDefaultPosition, new \wxSize($this->width, $this->height), wxTAB_TRAVERSAL, $this->title);
    }

    public function getRaw()
    {
        return $this->element;
    }
}