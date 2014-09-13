<?php

namespace Encore\Wx\Element;

class CheckBox implements \Encore\GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;
    use Traits\Wx;
    use Traits\Sizable;
    use Traits\Positionable;
    use Traits\Events;

    protected $events = [
        'onClick' => wxEVT_CHECKBOX
    ];

    public function setParent(\Encore\GIML\ElementInterface $parent)
    {
        $this->parent = $parent;

        $id = $this->collection->getTrueId($this->id);

        $this->element = new \wxCheckBox($parent->getParent()->getRaw(), $id, $this->text ?: $this->value, $this->getPosition(), $this->getSize());

        $this->bindEvents();

        $parent->getRaw()->Add($this->element);
    }
}