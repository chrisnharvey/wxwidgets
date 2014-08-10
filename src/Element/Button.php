<?php

namespace Encore\Wx\Element;

class Button implements \Encore\GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;
    use Traits\Wx;
    use Traits\Events;
    use Traits\Sizable;
    use Traits\Positionable;

    protected $events = [
        'onClick' => wxEVT_COMMAND_BUTTON_CLICKED
    ];

    public function setParent(\Encore\GIML\ElementInterface $parent)
    {
        $this->parent = $parent;

        $id = $this->collection->getTrueId($this->id);

        $this->element = new \wxButton($parent->getParent()->getRaw(), $id, $this->value, $this->getPosition(), $this->getSize(), 0 );

        $this->bindEvents();

        $parent->getRaw()->Add($this->element);
    }
}