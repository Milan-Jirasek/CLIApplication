<?php

namespace CLIApplication\Configuration;

/**
 * Class LocationConfigurationInterface
 *
 * @package CLIApplication\Configuration
 */
interface LocationConfigurationInterface
{
    /**
     * Check if cities count is allowed by configuration
     *
     * @param int $count
     * @return bool
     */
    public function hasLocationGetterAllowedCitiesCount(int $count): bool;
}