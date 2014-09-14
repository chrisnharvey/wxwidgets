<?php

namespace Encore\Wx\Element;

class MenuItem implements \Encore\Giml\ElementInterface
{
    use \Encore\Giml\ElementTrait;
    use Traits\Events;
    use Traits\Wx;

    protected $events = [
        'onSelect' => wxEVT_COMMAND_MENU_SELECTED
    ];

    public function init()
    {
        if ($this->type == 'separator') {
            return $this->parent->getRaw()->AppendSeparator();
        }

        $id = $this->collection->getTrueId($this->id);

        $title = "&{$this->title}";

        if ($this->shortcut) $title .= "\t{$this->shortcut}";

        $this->element = new \wxMenuItem($this->parent->getRaw(), wxID_ANY, $title, $this->description, wxITEM_NORMAL);

        $this->bindEvents();
        
        $this->parent->getRaw()->Append($this->element);
    }

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