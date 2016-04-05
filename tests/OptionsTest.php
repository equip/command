<?php

namespace Equip\Command;

use PHPUnit_Framework_TestCase as TestCase;

class OptionsTest extends TestCase
{
    public function testConstruction()
    {
        $values = [
            'email' => 'test@example.com',
            'password' => 'secret',
        ];

        $options = new TestedOptions($values);

        $this->assertSame($values['email'], $options->email);
        $this->assertSame($values['password'], $options->password);

        $this->assertArraySubset($values, $options->toArray());
    }

    public function testMissing()
    {
        $this->setExpectedExceptionRegExp(
            CommandException::class,
            '/required options not defined/i',
            CommandException::MISSING_OPTION
        );

        $options = new TestedOptions([]);
    }

    public function testMagicGet()
    {
        $values = [
            'email' => 'test@example.com',
            'password' => 'secret',
        ];

        $options = new TestedOptions($values);

        $this->assertSame($values['email'], $options->email);
        $this->assertSame($values['password'], $options->password);
    }

    public function testMagicSet()
    {
        $values = [
            'email' => 'test@example.com',
            'password' => 'secret',
        ];

        $options = new TestedOptions($values);

        $this->setExpectedExceptionRegExp(
            ImmutableException::class,
            '/object .* is immutable/i',
            ImmutableException::CANNOT_MODIFY
        );

        $options->email = 'fails';
    }

    public function testMagicUnset()
    {
        $values = [
            'email' => 'test@example.com',
            'password' => 'secret',
        ];

        $options = new TestedOptions($values);

        $this->setExpectedExceptionRegExp(
            ImmutableException::class,
            '/object .* is immutable/i',
            ImmutableException::CANNOT_MODIFY
        );

        unset($options->email);
    }
}
