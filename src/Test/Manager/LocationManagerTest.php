<?php

namespace CLIApplication\Test\Manager;

use CLIApplication\Entity\Location;
use CLIApplication\Manager\LocationManager;
use PHPUnit\Framework\TestCase;

class LocationManagerTest extends TestCase
{
    /**
     * @var LocationManager
     */
    protected $manager;

    public function setUp()
    {
        $this->manager = new LocationManager();
    }

    public function testCreate()
    {
        $expected = new Location();
        $expected
            ->setCity("City")
            ->setZip("ZipCode")
            ->setCounty("BeautifulCounty");

        $created = $this->manager->create([
            "city" => "City",
            "zip" => "ZipCode",
            "county" => "BeautifulCounty",
        ]);

        $this->assertEquals($expected, $created);
    }
}