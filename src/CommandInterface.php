<?php

namespace Equip\Command;

/**
 * Commands encapsulate the logic required to execute a business use case.
 *
 * All commands should be defined with a corresponding Options implementation.
 * These options should be attached to the command using a `withOptions()`
 * method that maintains the immutability of the command.
 *
 * The output of the command is not defined and will be specific to each command.
 */
interface CommandInterface
{
    /**
     * Execute the command using current options.
     *
     * @return mixed
     */
    public function execute();
}
