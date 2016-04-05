<?php

namespace Equip\Command;

use LogicException;

class ImmutableException extends LogicException
{
    const CANNOT_MODIFY = 1;

    /**
     * @param object $object
     *
     * @return static
     */
    public static function cannotModify($object)
    {
        return new static(
            sprintf(
                'Object `%s` is immutable and cannot be modified',
                get_class($object)
            ),
            static::CANNOT_MODIFY
        );
    }
}
