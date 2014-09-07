<?php

namespace Encore\Wx\Element;

use Encore\GIML;

class Frame implements GIML\ElementInterface
{
    use GIML\ElementTrait;
    use Traits\Wx;
    use Traits\Positionable;
    use Traits\Sizable;
    use Traits\Events;
    use Traits\Style;

    protected $events = [
        'onClose' => wxEVT_CLOSE_WINDOW,
        'onMinimize' => wxEVT_ICONIZE,
        'onMenuOpen' => wxEVT_MENU_OPEN,
        'onMenuClose' => wxEVT_MENU_CLOSE,
        'onMenuHighlight' => wxEVT_MENU_HIGHLIGHT,
    ];

    protected $styles = [
        'closeBox' => wxCLOSE_BOX
    ];

    public function init()
    {
        $this->element = new \wxFrame(null, wxID_ANY, $this->title, $this->getPosition(), $this->getSize(), wxDEFAULT_FRAME_STYLE|wxTAB_TRAVERSAL|$this->buildStyles());

        $this->bindEvents();
    }

    public function show()
    {
        $this->element->Show();
    }
}