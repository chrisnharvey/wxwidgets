<?php

namespace Encore\Wx\Element;

class Label implements \Encore\GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;
    use Traits\Sizable;
    use Traits\Positionable;
    use Traits\Wx;

    public function setParent(\Encore\GIML\ElementInterface $parent)
    {
        $this->element = new \wxStaticText($parent->getParent()->getRaw(), wxID_ANY, $this->value, $this->getPosition(), $this->getSize());
        $this->parent =& $parent;
        $parent->getRaw()->Add($this->element);
    }

    public function setValue($value)
    {
        if ($this->element) {
            $this->element->SetLabel($value);
        }

        $this->value = $value;
    }
}