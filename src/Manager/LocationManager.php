<?php

namespace CLIApplication\Manager;

use CLIApplication\Entity\Location;

class LocationManager implements ManagerInterface
{
    /**
     * Create object based on concrete implementation
     *
     * @return Location
     */
    public function create(): Location
    {
        return new Location();
    }
}