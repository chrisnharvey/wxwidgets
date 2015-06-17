<?php

namespace Encore\Wx\Element;

use wxFrame;
use Encore\Giml\ElementTrait;
use Encore\Giml\ElementInterface;
use Encore\Wx\Element\Traits\Wx;
use Encore\Wx\Element\Traits\Events;
use Encore\Wx\Element\Traits\Options;
use Encore\Wx\Element\Traits\Sizable;
use Encore\Wx\Element\Traits\Positionable;

class Frame implements ElementInterface
{
    use ElementTrait;
    use Wx;
    use Positionable;
    use Sizable;
    use Events;
    use Options;

    protected $events = [
        'onClose' => wxEVT_CLOSE_WINDOW,
        'onMinimize' => wxEVT_ICONIZE,
        'onMenuOpen' => wxEVT_MENU_OPEN,
        'onMenuClose' => wxEVT_MENU_CLOSE,
        'onMenuHighlight' => wxEVT_MENU_HIGHLIGHT,
    ];

    protected $options = [
        'closeBox' => wxCLOSE_BOX
    ];

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $this->element = new wxFrame(null, wxID_ANY, $this->title, $this->getPosition(), $this->getSize(), wxDEFAULT_FRAME_STYLE|wxTAB_TRAVERSAL|$this->buildOptions());

        $this->bindEvents();
    }
}