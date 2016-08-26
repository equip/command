<?php

namespace Equip\Command;

/**
 * Command options are value objects that cannot be modified once constructed.
 *
 * All options must self-validate during construction to ensure that internal
 * state is always valid.
 *
 * All options should be serializable to allow deferred command execution.
 *
 * Option values should only be exposed by getter methods.
 */
interface OptionsInterface
{
}
