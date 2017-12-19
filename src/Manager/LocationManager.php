<?php

namespace CLIApplication\Manager;

use CLIApplication\Entity\Location;

class LocationManager implements ManagerInterface
{
    /**
     * Create object based on concrete implementation
     *
     * @param array $data
     * @return Location
     */
    public function create(array $data = []): Location
    {
        $location = new Location();
        if (!empty($data)) {
            $this->setData($location, $data);
        }

        return $location;
    }

    /**
     * Setup possible data into location object
     *
     * @param Location $location
     * @param array $data
     */
    protected function setData(Location $location, array $data): void
    {
        if (array_key_exists("city", $data)) {
            $location->setCity($data["city"]);
        }
        if (array_key_exists("zip", $data)) {
            $location->setZip($data["zip"]);
        }
        if (array_key_exists("county", $data)) {
            $location->setCounty($data["county"]);
        }
    }
}