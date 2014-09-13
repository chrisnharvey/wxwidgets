<?php

namespace Encore\Wx\Element;

class RadioButton implements \Encore\Giml\ElementInterface
{
    use \Encore\Giml\ElementTrait;
    use Traits\Wx;
    use Traits\Sizable;
    use Traits\Positionable;
    use Traits\Events;

    protected $events = [
        'onClick' => wxEVT_RADIOBUTTON
    ];

    public function setParent(\Encore\Giml\ElementInterface $parent)
    {
        $this->parent = $parent;

        $id = $this->collection->getTrueId($this->id);

        $this->element = new \wxRadioButton($parent->getParent()->getRaw(), $id, $this->text ?: $this->value, $this->getPosition(), $this->getSize());

        $this->bindEvents();

        $parent->getRaw()->Add($this->element);
    }
}