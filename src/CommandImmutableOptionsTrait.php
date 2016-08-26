<?php

namespace Equip\Command;

/**
 * Provides immutable option switching functionality for commands.
 */
trait CommandImmutableOptionsTrait
{
    /**
     * Copy the current command with new options.
     *
     * @param OptionsInterface $options
     *
     * @return static
     */
    private function copyWithOptions(OptionsInterface $options)
    {
        $copy = clone $this;
        $copy->options = $options;

        return $copy;
    }
}
