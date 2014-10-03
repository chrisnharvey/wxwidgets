<?php

namespace Encore\Wx\Element;

use wxFrame;
use Encore\Giml\ElementTrait;
use Encore\Giml\ElementInterface;
use Encore\Wx\Element\Traits\Wx;
use Encore\Wx\Element\Traits\Events;
use Encore\Wx\Element\Traits\Style;
use Encore\Wx\Element\Traits\Sizable;
use Encore\Wx\Element\Traits\Positionable;

class Frame implements ElementInterface
{
    use ElementTrait;
    use Wx;
    use Positionable;
    use Sizable;
    use Events;
    use Style;

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

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $this->element = new wxFrame(null, wxID_ANY, $this->title, $this->getPosition(), $this->getSize(), wxDEFAULT_FRAME_STYLE|wxTAB_TRAVERSAL|$this->buildStyles());

        $this->bindEvents();
    }
}