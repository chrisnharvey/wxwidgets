<?php

namespace Encore\Wx\Element;

class TextBox implements \Encore\Giml\ElementInterface
{
    use \Encore\Giml\ElementTrait;
    use Traits\Wx;
    use Traits\Sizable;
    use Traits\Positionable;
    use Traits\Events;
    use Traits\Style;

    protected $events = [
        'onCut' => wxEVT_COMMAND_TEXT_CUT,
        'onEnter' => wxEVT_COMMAND_TEXT_ENTER,
        'onMaxLen' => wxEVT_COMMAND_TEXT_MAXLEN,
        'onPaste' => wxEVT_COMMAND_TEXT_PASTE,
        'onUpdated' => wxEVT_COMMAND_TEXT_UPDATED,
        'onUrl' => wxEVT_COMMAND_TEXT_URL
    ];

    protected $styles = [
        'processEnter' => wxTE_PROCESS_ENTER
    ];

    public function setParent(\Encore\Giml\ElementInterface $parent)
    {
        $this->parent = $parent;

        $id = $this->collection->getTrueId($this->id);

        $this->element = new \wxTextCtrl($parent->getParent()->getRaw(), $id, $this->value or wxEmptyString, $this->getPosition(), $this->getSize(), $this->buildStyles());

        $this->bindEvents();

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