<?php

namespace Equip\Command;

use PHPUnit_Framework_TestCase as TestCase;

class OptionsRequiredTraitTest extends TestCase
{
    use OptionsRequiredTrait;

    public function testCheckRequired()
    {
        $options = [
            'test' => true,
        ];

        $required = ['test'];

        $this->checkRequired($options, $required);
    }

    public function testCheckRequiredFailure()
    {
        $this->setExpectedExceptionRegExp(
            CommandException::class,
            '/required options/i',
            CommandException::MISSING_OPTION
        );

        $options = [];
        $required = ['test'];

        $this->checkRequired($options, $required);
    }
}
