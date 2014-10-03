<?php

namespace Encore\Wx\Element;

use wxSize;
use wxPanel;
use Encore\Giml\ElementTrait;
use Encore\Wx\Element\Traits\Wx;
use Encore\Giml\ElementInterface;

class Panel implements ElementInterface
{
    use ElementTrait;
    use Wx;

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $this->element = new wxPanel(null, wxID_ANY, wxDefaultPosition, new wxSize($this->width, $this->height), wxTAB_TRAVERSAL, $this->title);
    }
}