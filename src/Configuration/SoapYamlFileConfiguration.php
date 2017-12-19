<?php

namespace CLIApplication\Configuration;

use Symfony\Component\Yaml\Yaml;

/**
 * Class SoapYamlFileConfiguration
 *
 * @package CLIApplication\Configuration
 */
class SoapYamlFileConfiguration implements LocationConfigurationInterface
{
    /**
     * @var array|mixed
     */
    protected $config = [];

    /**
     * SoapYamlFileConfiguration constructor.
     *
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->config = Yaml::parseFile($filePath);
    }

    /**
     * Check if cities count is allowed by configuration
     *
     * @param int $count
     * @return bool
     */
    public function hasLocationGetterAllowedCitiesCount(int $count): bool
    {
        // TODO: Implement hasLocationGetterAllowedCitiesCount() method.
    }

    public function getWsdl(): string
    {
        // TODO
    }
}