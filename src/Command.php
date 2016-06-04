<?php

namespace Equip\Command;

/**
 * A general purpose command class.
 *
 * @since 1.3.0
 */
abstract class Command
{
    /**
     * @var Options
     */
    private $options;

    /**
     * Execute the command using the current options.
     *
     * @return mixed
     */
    abstract public function execute();

    /**
     * Allow usage as a callable.
     *
     * @see Command::execute()
     *
     * @return mixed
     */
    final public function __invoke()
    {
        return $this->execute();
    }

    /**
     * Get the currently defined options.
     *
     * @return Options
     *
     * @throws CommandException
     *  If no options have been added to the command.
     */
    final public function options()
    {
        if (!$this->options) {
            throw CommandException::needsOptions($this);
        }

        return $this->options;
    }

    /**
     * Get a copy with new options.
     *
     * @param Options $options
     *
     * @return static
     */
    final public function withOptions(Options $options)
    {
        $copy = clone $this;
        $copy->options = $options;

        return $copy;
    }
}
