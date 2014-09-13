<?php

namespace Encore\Wx;

use Encore\Wx\Element\Frame;
use Encore\Wx\Element\Dialog;
use Encore\Giml\ElementInterface;
use Encore\Giml\CollectionInterface;
use Encore\Controller\ControllerAwareTrait;
use Encore\Controller\ControllerAwareInterface;
use Encore\Giml\Exception\DuplicateIdException;

class Collection implements CollectionInterface, ControllerAwareInterface
{
    use ControllerAwareTrait;

    protected $objects = [];
    protected $ids = [];

    public function add(ElementInterface $element)
    {
        $id = $element->id;

        if ($id === null) $id = $this->generateId();

        $element->id = $id;

        $this->checkId($id);

        // Reassign element
        $elem = $element;
        $element = $elem;

        $this->objects[] = $element;

        if (count($this->objects) === 1) {
            array_unshift($this->objects, 'pseudo');
            unset($this->objects[0]);
        }

        $this->ids[array_search($element, $this->objects, true)] = $id;
    }

    public function getTopLevelWindow()
    {
        foreach ($this->objects as $object) {
            if ($object instanceof Frame
            or $object instanceof Dialog) {
                return $object;
            }
        }
    }

    public function remove($element)
    {
        $trueId = $this->getTrueId($element);

        $this->objects[$trueId]->destroy();

        unset($this->objects[$trueId]);
        unset($this->ids[$trueId]);
    }

    public function getElementById($id)
    {
        $id = $this->getTrueId($id);

        if ($id === false) {
            // Throw something
            return;
        }

        return $this->objects[$id];
    }

    public function getTrueId($id)
    {
        return array_search($id, $this->ids, true);
    }

    public function generateId()
    {
        return uniqid('auto', true);
    }

    protected function checkId($id)
    {
        if (in_array($id, $this->ids)) {
            throw new DuplicateIdException("The ID '{$id}' is already in use");
        }
    }
}