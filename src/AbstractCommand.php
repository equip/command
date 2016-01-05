<?php

namespace Equip\Command;

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
            foreach ($required as $key) {
                if (!isset($this->options[$key])) {
                    throw CommandException::missingOption($key);
                }
            }
        }

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
}
