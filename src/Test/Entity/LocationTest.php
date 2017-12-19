<?php

namespace CLIApplication\Test\Entity;

use CLIApplication\Entity\Location;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    /** @var  Location */
    protected $entity;

    public function setUp()
    {
        $this->entity = new Location();
        $this->entity
            ->setCity("Městečko")
            ->setZip("PSČ");
    }

    /**
     * @dataProvider locationDataProvider
     */
    public function testLocationData(string $methodName, $expectedValue)
    {
        $this->assertEquals($expectedValue, $this->entity->{$methodName}());
    }

    public function locationDataProvider()
    {
        return [
            "test getCity" => ["getCity", "Městečko"],
            "test getZip" => ["getZip", "PSČ"],
        ];
    }
}