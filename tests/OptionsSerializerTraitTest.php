<?php

namespace Equip\Command;

use JsonSerializable;
use PHPUnit_Framework_TestCase as TestCase;

class OptionsSerializerTraitTest extends TestCase implements JsonSerializable
{
    use OptionsSerializerTrait;

    public function testSerialize()
    {
        $json = json_encode($this);

        $this->assertJson($json);
    }
}
