<?php

namespace Equip\Command;

use PHPUnit_Framework_TestCase as TestCase;

class AbstractCommandTest extends TestCase
{
    /**
     * @var AbstractCommand
     */
    private $command;

    public function setUp()
    {
        $this->command = $this->getMockForAbstractClass(AbstractCommand::class);
    }

    public function testOptions()
    {
        $options = [
            'user_id'    => 5,
            'account_id' => 1,
        ];

        $this->assertEmpty($this->command->options());

        // Copy the command and replace options
        $command = $this->command->withOptions($options);

        // Original command options should still be empty
        $this->assertEmpty($this->command->options());

        // The command should be copied
        $this->assertNotSame($command, $this->command);

        // And the options in the new command should match
        $this->assertSame($options, $command->options());

        $added = [
            'start_time' => new \DateTime,
        ];

        // Copy the command and add options
        $modified = $command->addOptions($added);

        $this->assertNotSame($command, $modified);

        // Options should be combined
        $this->assertSame(array_replace($options, $added), $modified->options());

        // Copy the command and replace options
        $replaced = $command->withOptions($added);

        // Options should be replaced
        $this->assertSame($added, $replaced->options());
    }

    public function testHasOption()
    {
        $command = $this->command->withOptions([
            'foo' => true,
            'bar' => false,
            'baz' => null,
        ]);

        // Empty values allowed
        $this->assertTrue($command->hasOption('foo'));
        $this->assertTrue($command->hasOption('bar'));
        $this->assertFalse($command->hasOption('baz'));
        $this->assertFalse($command->hasOption('fiz'));
    }

    public function testRequiredOptions()
    {
        $this->command
            ->expects($this->once())
            ->method('requiredOptions')
            ->willReturn([
                'user_id',
            ]);

        $command = $this->command->withOptions([
            'user_id' => 0,
            'okay'    => true,
        ]);

        $options = $command->options();

        $this->assertArrayHasKey('user_id', $options);
    }

    public function testRequiredOptionsFailure()
    {
        $this->command
            ->expects($this->once())
            ->method('requiredOptions')
            ->willReturn([
                'user_id',
                'article_id',
            ]);

        $this->setExpectedExceptionRegExp(
            CommandException::class,
            '/required options not defined.+user_id.+article_id/i',
            CommandException::MISSING_OPTION
        );

        $this->command->options();
    }

    public function testExecute()
    {
        $this->command->method('execute')
            ->willReturn(true);

        $output = $this->command->execute();

        $this->assertTrue($output);
    }

    public function testDefaultOptions()
    {
        $command = $this->getMockBuilder(AbstractCommand::class)
            ->setMethods(['defaultOptions'])
            ->getMockForAbstractClass();

        $command
            ->expects($this->once())
            ->method('defaultOptions')
            ->willReturn([
                'test' => true,
            ]);

        $options = $command->options();

        $this->assertArrayHasKey('test', $options);
        $this->assertTrue($options['test']);
    }
}
