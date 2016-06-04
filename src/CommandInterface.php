<?php

namespace Equip\Command;

/**
 * @deprecated since 1.3.0 in favor of Command
 */
interface CommandInterface
{
    /**
     * Get the current options
     *
     * @throws \Equip\Command\CommandException If any required options are missing
     *
     * @return array
     */
    public function options();

    /**
     * Get a copy with replaced options
     *
     * @param array $options
     *
     * @return static
     */
    public function withOptions(array $options);

    /**
     * Get a copy with added options
     *
     * @param array $options
     *
     * @return static
     */
    public function addOptions(array $options);

    /**
     * Check if an option is defined
     *
     * Empty values (except `null`) are allowed!
     *
     * @param string $name
     *
     * @return boolean
     */
    public function hasOption($name);

    /**
     * Get a list of options that must be defined
     *
     * @return array
     */
    public function requiredOptions();

    /**
     * Get a hash of default options
     *
     * @return array
     */
    public function defaultOptions();

    /**
     * Execute the command using the current options
     *
     * @return mixed
     */
    public function execute();
}
