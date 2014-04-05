<?php

namespace Encore\Wx\Element;

use Encore\GIML;

class Frame implements GIML\ElementInterface
{
    use GIML\ElementTrait;
    use Traits\Wx;
    use Traits\Positionable;
    use Traits\Sizable;

    public function init()
    {
        $this->element = new \wxFrame(null, wxID_ANY, $this->title, $this->getPosition(), $this->getSize(), wxDEFAULT_FRAME_STYLE|wxTAB_TRAVERSAL);
    }

    public function show()
    {
        $this->element->Show();
    }
}