<?php

namespace Equip\Command;

use PHPUnit_Framework_TestCase as TestCase;

class OptionsHydrateTraitTest extends TestCase
{
    use OptionsHydrateTrait;

    private $hydrated = false;

    public function testHydrate()
    {
        $this->assertFalse($this->hydrated);

        $this->hydrate([
            'hydrated' => true,
        ]);

        $this->assertTrue($this->hydrated);
    }
}
