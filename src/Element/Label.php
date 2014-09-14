<?php

namespace Encore\Wx\Element;

class Label implements \Encore\Giml\ElementInterface
{
    use \Encore\Giml\ElementTrait;
    use Traits\Sizable;
    use Traits\Positionable;
    use Traits\Wx;

    public function init()
    {
        $this->element = new \wxStaticText($this->parent->getParent()->getRaw(), wxID_ANY, $this->text ?: $this->value, $this->getPosition(), $this->getSize());

        $this->parent->getRaw()->Add($this->element);
    }

    public function setValue($value)
    {
        if ($this->element) {
            $this->element->SetLabel($value);
        }

        $this->value = $value;
    }
}