<?php

namespace Equip\Command;

use RuntimeException;

class CommandException extends RuntimeException
{
    const NO_OPTIONS = 2000;
    const MISSING_OPTION = 2000;

    /**
     * @param Command $command
     *
     * @return static
     *
     * @since 1.3.0
     */
    public static function needsOptions(Command $command)
    {
        return new static(sprintf(
            'No options have been set for the `%s` command',
            get_class($command)
        ), static::NO_OPTIONS);
    }

    /*
     * @param array $names
     *
     * @return static
     *
     * @since 1.2.0
     */
    public static function missingOptions(array $names)
    {
        return new static(
            sprintf('Required options not defined: `%s`', implode('`, `', $names)),
            static::MISSING_OPTION
        );
    }

    /**
     * @param string $name
     *
     * @return static
     *
     * @deprecated 1.2.0
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
