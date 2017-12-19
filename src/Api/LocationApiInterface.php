<?php

namespace CLIApplication\Api;

/**
 * Interface LocationApiInterface
 *
 * @package CLIApplication\Api
 */
interface LocationApiInterface
{
    /**
     * Return array of Locations objects
     *
     * @param array $cities
     * @return array
     */
    public function getLocationsByCities(array $cities): array;
}