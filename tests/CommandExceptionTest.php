<?php

namespace EquipTests\Command;

use Equip\Command\CommandException;

class CommandExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testMissingOption()
    {
        $exception = CommandException::missingOption('test');

        $this->assertRegExp('/required option/i', $exception->getMessage());
        $this->assertSame(CommandException::MISSING_OPTION, $exception->getCode());
        $this->assertSame(400, $exception->getHttpStatus());
    }

    public function testDefaultHttpStatus()
    {
        $exception = new CommandException();

        $this->assertSame(500, $exception->getHttpStatus());
    }
}
