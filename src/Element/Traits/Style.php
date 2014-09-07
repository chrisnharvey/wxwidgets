<?php

namespace Encore\Wx\Element\Traits;

trait Style
{
    protected function getStyle($style)
    {
        return in_array($style, $this->getStyles())
            ? $this->getStyles()[$style]
            : null;
    }

    protected function getStyles()
    {
        return $this->style;
    }

    protected function buildStyles(array $defaults = null)
    {
        $styles = $this->getStyles();

        if ($defaults) $styles = array_merge($defaults, $styles);

        foreach ($styles as $style) {
            if ( ! array_key_exists($style, $this->styles)) continue;

            if ( ! isset($styleBitwise)) {
                $styleBitwise = $this->styles[$style];
                continue;
            }

            $styleBitwise = $styleBitwise | $this->styles[$style];
        }

        return isset($styleBitwise) ? $styleBitwise : null;
    }
}