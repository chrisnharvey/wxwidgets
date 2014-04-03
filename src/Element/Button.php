<?php

namespace Encore\Wx\Element;

class Button implements \Encore\GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;

    public function setParent(\Encore\GIML\ElementInterface $parent)
    {
        $this->parent = $parent;

        $id = $this->collection->getTrueId($this->id);

        $this->element = new \wxButton($parent->getParent()->getRaw(), $id, $this->value, wxDefaultPosition, wxDefaultSize, 0 );

        $this->bindEvents();

        $parent->getRaw()->Add($this->element);
    }

    public function getRaw()
    {
        return $this->element;
    }

    protected function bindEvents()
    {
        $id = $this->collection->getTrueId($this->id);

        if ($this->onClick) {
            $this->element->Connect($id, wxEVT_COMMAND_BUTTON_CLICKED, [$this, 'click']);
        }
    }

    public function click()
    {
        $controller = $this->collection->getController();

        return call_user_func_array([$controller, $this->onClick], []);
    }
}