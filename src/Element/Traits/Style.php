<?php

namespace Encore\Wx\Element\Traits;

trait Style
{
    /**
     * Get a style constant from its name
     * 
     * @param  string $style
     * @return integer
     */
    protected function getStyle($style)
    {
        return in_array($style, $this->getStyles())
            ? $this->getStyles()[$style]
            : null;
    }

    /**
     * Get the style to constant map
     * 
     * @return array
     */
    protected function getStyles()
    {
        return $this->style;
    }

    /**
     * Build the style constant using the bitwise operator
     * 
     * @param  array $defaults
     * @return integer
     */
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