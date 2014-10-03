<?php

namespace Encore\Wx\Element;

use wxStaticText;
use Encore\Giml\ElementTrait;
use Encore\Giml\ElementInterface;
use Encore\Wx\Element\Traits\Wx;
use Encore\Wx\Element\Traits\Sizable;
use Encore\Wx\Element\Traits\Positionable;

class Label implements ElementInterface
{
    use ElementTrait;
    use Sizable;
    use Positionable;
    use Wx;

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $this->element = new wxStaticText($this->parent->getParent()->getRaw(), wxID_ANY, $this->text ?: $this->value, $this->getPosition(), $this->getSize());

        $this->parent->getRaw()->Add($this->element);
    }

    /**
     * Set the label value
     * 
     * @param string $value
     */
    public function setValue($value)
    {
        if ($this->element) {
            $this->element->SetLabel($value);
        }

        $this->value = $value;
    }
}