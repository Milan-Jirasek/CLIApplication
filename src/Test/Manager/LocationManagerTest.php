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
        $created = $this->manager->create();
        $this->assertInstanceOf(Location::class, $created);
    }
}