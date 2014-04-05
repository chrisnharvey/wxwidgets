<?php

namespace Encore\Wx\Element;

use Encore\GIML;

class Frame implements GIML\ElementInterface
{
    use GIML\ElementTrait;
    use Traits\Wx;

    public function init()
    {
        $this->element = new \wxFrame(null, wxID_ANY, $this->title, new \wxPoint($this->x, $this->y), new \wxSize($this->width, $this->height), wxDEFAULT_FRAME_STYLE|wxTAB_TRAVERSAL);
    }

    public function show()
    {
        $this->element->Show();
    }
}