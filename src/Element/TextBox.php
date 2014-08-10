<?php

namespace Encore\Wx\Element;

class TextBox implements \Encore\GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;
    use Traits\Wx;
    use Traits\Sizable;
    use Traits\Positionable;

    public function setParent(\Encore\GIML\ElementInterface $parent)
    {
        $this->parent = $parent;

        $id = $this->collection->getTrueId($this->id);

        $this->element = new \wxTextCtrl($parent->getParent()->getRaw(), $id, $this->value or wxEmptyString, $this->getPosition(), $this->getSize(), 0);

        $parent->getRaw()->Add($this->element);
    }

    public function getValue()
    {
        if ($this->element) {
            $this->value = $this->element->GetValue();
        }

        return $this->value;
    }
}