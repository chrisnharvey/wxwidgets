<?php

namespace Encore\Wx;

use Encore\GIML;
use Encore\GIML\Exception\DuplicateIdException;

class Collection implements \Encore\GIML\CollectionInterface
{
    protected $objects = [];
    protected $ids = [];

    public function add(GIML\ElementInterface $element)
    {
        $id = $element->id;

        if ($id === null) $id = $this->generateId();

        $this->checkId($id);

        $this->objects[] = $element;

        if (count($this->objects) === 1) {
            array_unshift($this->objects, 'pseudo');
            unset($this->objects[0]);
        }

        $this->ids[array_search($element, $this->objects, true)] = $id;
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