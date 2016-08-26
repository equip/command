<?php

namespace Equip\Command;

/**
 * Provides required parameter functionality for options.
 */
trait OptionsRequiredTrait
{
    /**
     * Check that the given options contain all required keys.
     *
     * @param array $options
     * @param array $keys
     *
     * @return void
     *
     * @throws CommandException
     *  If any required options are missing.
     */
    private function checkRequired(array $options, array $keys)
    {
        $missing = array_diff_key(array_flip($keys), $options);

        if (!empty($missing)) {
            throw CommandException::missingOptions($missing);
        }
    }
}
