<?php

namespace Encore\Wx\Element;

use wxMenuItem;
use Encore\Giml\ElementTrait;
use Encore\Wx\Element\Traits\Wx;
use Encore\Wx\Element\Traits\Events;
use Encore\Giml\ElementInterface;

class MenuItem implements ElementInterface
{
    use ElementTrait;
    use Events;
    use Wx;

    protected $events = [
        'onSelect' => wxEVT_COMMAND_MENU_SELECTED
    ];

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        if ($this->type == 'separator') {
            return $this->parent->getRaw()->AppendSeparator();
        }

        $id = $this->collection->getTrueId($this->id);

        $title = "&{$this->title}";

        if ($this->shortcut) $title .= "\t{$this->shortcut}";

        $this->element = new wxMenuItem($this->parent->getRaw(), wxID_ANY, $title, $this->description, wxITEM_NORMAL);

        $this->bindEvents();
        
        $this->parent->getRaw()->Append($this->element);
    }

    /**
     * Get the menu item type
     * 
     * @return integer
     */
    protected function getType()
    {
        switch ($this->type) {
            case 'about':
                return wxID_ABOUT;

            case 'exit':
                return wxID_EXIT;

            case 'preferences':
                return wxID_PREFERENCES;

            case 'help':
                return wxID_HELP;

            default:
                return wxID_ANY;
        }
    }
}