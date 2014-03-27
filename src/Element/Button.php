<?php

namespace Encore\Wx\Element;

class Button implements \Encore\GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;

    public function setParent(\Encore\GIML\ElementInterface $parent)
    {
        $this->parent = $parent;

        $this->element = new \wxButton($parent->getParent()->getRaw(), wxID_ANY, $this->value, wxDefaultPosition, wxDefaultSize, 0 );

        $parent->getRaw()->Add($this->element);
    }

    public function getRaw()
    {
        return $this->element;
    }
}