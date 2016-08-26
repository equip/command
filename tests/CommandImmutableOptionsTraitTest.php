<?php

namespace Equip\Command;

use PHPUnit_Framework_TestCase as TestCase;

class CommandImmutableOptionsTraitTest extends TestCase
{
    use CommandImmutableOptionsTrait;

    private $options;

    public function testCopyWithOptions()
    {
        $this->options = $this->getMock(OptionsInterface::class);

        $changed = $this->getMock(OptionsInterface::class);
        $copy = $this->copyWithOptions($changed);

        $this->assertNotSame($this, $copy);
        $this->assertSame($changed, $copy->options);
    }
}
