<?php

namespace Equip\Command;

use RuntimeException;

class CommandException extends RuntimeException
{
    const MISSING_OPTION = 2000;

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

    /**
     * Get the HTTP status for the exception.
     *
     * @return integer
     */
    public function getHttpStatus()
    {
        if ($this->getCode() === static::MISSING_OPTION) {
            return 400;
        }

        return 500;
    }
}
