<?php

namespace Encore\Wx\Element;

use wxCheckBox;
use Encore\Giml\ElementTrait;
use Encore\Giml\ElementInterface;
use Encore\Wx\Element\Traits\Wx;
use Encore\Wx\Element\Traits\Events;
use Encore\Wx\Element\Traits\Sizable;
use Encore\Wx\Element\Traits\Positionable;

class CheckBox implements ElementInterface
{
    use ElementTrait;
    use Wx;
    use Sizable;
    use Positionable;
    use Events;

    protected $events = [
        'onClick' => wxEVT_CHECKBOX
    ];

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $id = $this->collection->getTrueId($this->id);

        $this->element = new wxCheckBox($this->parent->getParent()->getRaw(), $id, $this->text ?: $this->value, $this->getPosition(), $this->getSize());

        $this->bindEvents();

        $this->parent->getRaw()->Add($this->element);
    }
}