<?php

namespace Encore\Wx\Element;

use wxButton;
use Encore\Giml\ElementTrait;
use Encore\Giml\ElementInterface;
use Encore\Wx\Element\Traits\Wx;
use Encore\Wx\Element\Traits\Events;
use Encore\Wx\Element\Traits\Sizable;
use Encore\Wx\Element\Traits\Positionable;

class Button implements ElementInterface
{
    use ElementTrait;
    use Wx;
    use Events;
    use Sizable;
    use Positionable;

    protected $events = [
        'onClick' => wxEVT_COMMAND_BUTTON_CLICKED
    ];

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $id = $this->collection->getTrueId($this->id);

        $this->element = new wxButton($this->parent->getParent()->getRaw(), $id, $this->text ?: $this->value, $this->getPosition(), $this->getSize(), 0 );

        $this->bindEvents();

        $this->parent->getRaw()->Add($this->element);
    }
}