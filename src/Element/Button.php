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

    public function setParent(\Encore\Giml\ElementInterface $parent)
    {
        $this->parent = $parent;

        $id = $this->collection->getTrueId($this->id);

        $this->element = new \wxButton($parent->getParent()->getRaw(), $id, $this->text ?: $this->value, $this->getPosition(), $this->getSize(), 0 );

        $this->bindEvents();

        $parent->getRaw()->Add($this->element);
    }
}