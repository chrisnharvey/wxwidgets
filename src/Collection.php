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

    /**
     * Add an element to the collection
     * 
     * @param ElementInterface $element
     */
    public function add(ElementInterface $element)
    {
        $id = $element->id;

        if ($id === null) $id = $this->generateId();

        $element->id = $id;

        $this->checkId($id);

        $this->objects[] = $element;

        if (count($this->objects) === 1) {
            array_unshift($this->objects, 'pseudo');
            unset($this->objects[0]);
        }

        $this->ids[array_search($element, $this->objects, true)] = $id;
    }

    /**
     * Get the top-level window element
     * 
     * @return ElementInterface
     */
    public function getTopLevelWindow()
    {
        foreach ($this->objects as $object) {
            if ($object instanceof Frame
            or $object instanceof Dialog) {
                return $object;
            }
        }
    }

    /**
     * Remove the element from the collection
     * 
     * @return void
     */
    public function remove($element)
    {
        $trueId = $this->getTrueId($element);

        $this->objects[$trueId]->destroy();

        unset($this->objects[$trueId]);
        unset($this->ids[$trueId]);
    }

    /**
     * Get an element by its ID
     * 
     * @param  string|int $id
     * @return ElementInterface
     */
    public function getElementById($id)
    {
        $id = $this->getTrueId($id);

        if ($id === false) {
            // Throw something
            return;
        }

        return $this->objects[$id];
    }

    /**
     * Get the true ID for a custom element ID
     * 
     * @param  mixed $id
     * @return int
     */
    public function getTrueId($id)
    {
        return array_search($id, $this->ids, true);
    }

    /**
     * Generate an ID if one wasn't specified
     * 
     * @return string
     */
    public function generateId()
    {
        return uniqid('auto', true);
    }

    /**
     * Check an ID does not already exist
     * 
     * @param  mixed $id
     * @throws DuplicateIdException
     * @return void
     */
    protected function checkId($id)
    {
        if (in_array($id, $this->ids)) {
            throw new DuplicateIdException("The ID '{$id}' is already in use");
        }
    }
}
