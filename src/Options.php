<?php

namespace Equip\Command;

/**
 * A general purpose value object for command options.
 *
 * When constructed, all required options must be passed.
 *
 * @since 1.3.0
 */
abstract class Options
{
    /**
     * Check that all required options are defined, then hydrate.
     *
     * @param array $values
     */
    final public function __construct(array $values)
    {
        // Remove any values that are invalid for this set of options
        $values = array_intersect_key(
            $values,
            array_flip($this->valid())
        );

        $this->ensureRequired($values);

        foreach ($values as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Get a list of all required options.
     *
     *     return [
     *         'email',
     *         'password',
     *     ];
     *
     * @return array
     */
    abstract public function required();

    /**
     * Get a list of all valid options.
     *
     * @return array
     */
    public function valid()
    {
        return array_keys($this->toArray());
    }

    /**
     * Get all options as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Provide read-only access to attributes.
     *
     * @param string $key
     *
     * @return mixed
     */
    final public function __get($key)
    {
        return $this->{$key};
    }

    /**
     * Prevent modification.
     *
     * @throws ImmutableException
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    final public function __set($key, $value)
    {
        throw ImmutableException::cannotModify($this);
    }

    /**
     * Prevent modification.
     *
     * @throws ImmutableException
     *
     * @param string $key
     *
     * @return void
     */
    final public function __unset($key)
    {
        throw ImmutableException::cannotModify($this);
    }

    /**
     * Ensure that all required options are included in the given values.
     *
     * @param array $values
     *
     * @return void
     *
     * @throws CommandException
     *  If any required options have not been defined.
     */
    private function ensureRequired(array $values)
    {
        $defined = array_filter($values, static function ($value) {
            return $value !== null;
        });

        $missing = array_diff($this->required(), array_keys($defined));

        if ($missing) {
            throw CommandException::missingOptions($missing);
        }
    }
}
