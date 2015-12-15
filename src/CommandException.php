<?php

namespace Spark\Command;

use RuntimeException;

class CommandException extends RuntimeException
{
    const MISSING_OPTION = 5990;

    /**
     * @param string $name
     *
     * @return static
     */
    public static function missingOption($name)
    {
        return new static(
            sprintf('Required option `%s` is not defined', $name),
            static::MISSING_OPTION
        );
    }
}
