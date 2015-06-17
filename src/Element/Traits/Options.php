<?php

namespace Encore\Wx\Element\Traits;

trait Options
{
    /**
     * Get a option constant from its name
     * 
     * @param  string $option
     * @return integer
     */
    protected function getOption($option)
    {
        return in_array($option, $this->getOptions())
            ? $this->getOptions()[$option]
            : null;
    }

    /**
     * Get the option to constant map
     * 
     * @return array
     */
    protected function getOptions()
    {
        return $this->options;
    }

    /**
     * Build the options constant using the bitwise operator
     * 
     * @param  array $defaults
     * @return integer
     */
    protected function buildOptions(array $defaults = null)
    {
        $options = $this->getOptions();

        if ($defaults) $options = array_merge($defaults, $options);

        foreach ($options as $option) {
            if ( ! array_key_exists($option, $this->options)) continue;

            if ( ! isset($optionsBitwise)) {
                $optionsBitwise = $this->options[$option];
                continue;
            }

            $optionsBitwise = $optionsBitwise | $this->options[$option];
        }

        return isset($optionsBitwise) ? $optionsBitwise : null;
    }
}