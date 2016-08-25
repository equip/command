<?php

namespace Equip\Command;

/**
 * Provides JsonSerializable functionality for options.
 */
trait OptionsSerializerTrait
{
    // JsonSerializable
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
