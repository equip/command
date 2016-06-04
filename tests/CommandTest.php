<?php

namespace Equip\Command;

use PHPUnit_Framework_TestCase as TestCase;

class CommandTest extends TestCase
{
    public function setUp()
    {
        $this->command = $this->getMockForAbstractClass(Command::class);
    }

    public function testUndefinedOptions()
    {
        $this->setExpectedExceptionRegExp(
            CommandException::class,
            '/no options have been set/i',
            CommandException::NO_OPTIONS
        );

        $options = $this->command->options();
    }

    private function getMockOptions()
    {
        return $this->getMockBuilder(Options::class)
            ->disableOriginalConstructor(true)
            ->getMock();
    }

    public function testOptions()
    {
        $options = $this->getMockOptions();

        // Copy the command and replace options
        $command = $this->command->withOptions($options);

        // The command should be copied
        $this->assertNotSame($command, $this->command);

        // And the options in the new command should match
        $this->assertSame($options, $command->options());

        $modified = $this->command->withOptions(
            $this->getMockOptions()
        );

        // Options should be replaced
        $this->assertNotSame($command->options(), $modified->options());
    }

    public function testExecute()
    {
        $this->command
            ->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $output = $this->command->execute();

        $this->assertTrue($output);
    }

    public function testInvoke()
    {
        $this->command
            ->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $output = call_user_func($this->command);

        $this->assertTrue($output);
    }
}
