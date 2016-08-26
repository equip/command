<?php

namespace Equip\Command;

/**
 * Provides hydrating functionality for options.
 */
trait OptionsHydrateTrait
{
    /**
     * Hydrate the current object with the given values.
     *
     * Values should be filtered beforehand so that only properties that exist
     * in the object are passed.
     *
     * @param array $values
     *
     * @return void
     */
    private function hydrate(array $values)
    {
        foreach ($values as $key => $value) {
            $this->$key = $value;
        }
    }
}
