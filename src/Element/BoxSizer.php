<?php

namespace Encore\Wx\Element;

use Encore\GIML;

class BoxSizer implements GIML\ElementInterface
{
    use \Encore\GIML\ElementTrait;

    public function init()
    {
        $this->element = new \wxBoxSizer($this->orientation == 'horizontal'
            ? wxHORIZONTAL
            : wxVERTICAL);
    }

    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    public function setParent(GIML\ElementInterface $parent)
    {
        $this->parent = $parent;
        $this->parent->getRaw()->SetSizer($this->getRaw());
    }

    public function getRaw()
    {
        return $this->element;
    }

    protected function setAttribute($key, $value)
    {
        switch ($key) {
            case 'orientation':
                $this->attributes[$key] = $this->assert(
                    $value == 'horizontal',
                    wxHORIZONTAL,
                    wxVERTICAL
                );
            default:
                $this->attributes[$key] = $value;
            break;
        }
    }

    protected function assert($assertion, $true = true, $false = false)
    {
        if ($assertion) return $true;

        return $false;
    }
}