<?php

namespace Equip\Command;

/**
 * @deprecated since 1.3.0 in favor of Command
 */
abstract class AbstractCommand implements CommandInterface
{
    /**
     * @var array
     */
    private $options = [];

    /**
     * @inheritDoc
     */
    public function options()
    {
        $required = $this->requiredOptions();

        if ($required) {
            $missing = array_diff($required, array_keys($this->options));
            if ($missing) {
                throw CommandException::missingOptions($missing);
            }
        }

        $this->options += $this->defaultOptions();

        return $this->options;
    }

    /**
     * @inheritDoc
     */
    public function withOptions(array $options)
    {
        $copy = clone $this;
        $copy->options = $options;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function addOptions(array $options)
    {
        $copy = clone $this;
        $copy->options = array_replace($copy->options, $options);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function hasOption($name)
    {
        return isset($this->options[$name]);
    }

    /**
     * @inheritDoc
     */
    public function defaultOptions()
    {
        return [];
    }
}
