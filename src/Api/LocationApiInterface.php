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
     * Return locations array
     *
     * @param array $cities
     * @return array
     */
    public function getLocationsByCities(array $cities): array;
}