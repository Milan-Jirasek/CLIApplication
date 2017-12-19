<?php

namespace CLIApplication\Configuration;

/**
 * Class AbstractLocationConfiguration
 *
 * @package CLIApplication\Configuration
 */
abstract class AbstractLocationConfiguration implements LocationConfigurationInterface
{
    /**
     * AbstractLocationConfiguration constructor.
     */
    public function __construct()
    {
        $this->checkMandatoryAttributes();
    }

    /**
     * Check mandatory configuration attributes by concrete implementation
     */
    abstract protected function checkMandatoryAttributes(): void;
}