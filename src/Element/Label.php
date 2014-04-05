<?php

namespace Encore\Wx\Element;

class Label implements \Encore\GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;

    public function setParent(\Encore\GIML\ElementInterface &$parent)
    {
        $this->element = new \wxStaticText($parent->getParent()->getRaw(), wxID_ANY, $this->value, wxDefaultPosition, wxDefaultSize);
        $this->parent = $parent;
        $parent->getRaw()->Add($this->element);
    }

    public function getRaw()
    {
        return $this->element;
    }
}