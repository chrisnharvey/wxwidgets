<?php

namespace Encore\Wx\Element;

class Button implements \Encore\Giml\ElementInterface
{
    use \Encore\Giml\ElementTrait;
    use Traits\Wx;
    use Traits\Events;
    use Traits\Sizable;
    use Traits\Positionable;

    protected $events = [
        'onClick' => wxEVT_COMMAND_BUTTON_CLICKED
    ];

    public function init()
    {
        $id = $this->collection->getTrueId($this->id);

        $this->element = new \wxButton($this->parent->getParent()->getRaw(), $id, $this->text ?: $this->value, $this->getPosition(), $this->getSize(), 0 );

        $this->bindEvents();

        $this->parent->getRaw()->Add($this->element);
    }
}