<?php

namespace CLIApplication\Configuration;

use CLIApplication\Exception\MissingConfigurationAttribute;
use Symfony\Component\Yaml\Yaml;

/**
 * Class SoapYamlFileConfiguration
 *
 * @package CLIApplication\Configuration
 */
class SoapYamlFileConfiguration extends AbstractLocationConfiguration
{
    /**
     * @var array|mixed
     */
    protected $config = [];

    /**
     * @var array
     */
    protected $mandatoryAttributes = [
        "wsdl",
        "cities_count_from",
        "cities_count_to"
    ];

    /**
     * SoapYamlFileConfiguration constructor.
     *
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->config = Yaml::parseFile($filePath);
        parent::__construct();
    }

    /**
     * Check if cities count is allowed by configuration
     *
     * @param int $count
     * @return bool
     */
    public function hasLocationGetterAllowedCitiesCount(int $count): bool
    {
        return $count >= $this->config["cities_count_from"] && $count <= $this->config["cities_count_to"];
    }

    /**
     * Return wsdl
     *
     * @return string
     */
    public function getWsdl(): string
    {
        return $this->config["wsdl"];
    }

    /**
     * Check mandatory configuration attributes by concrete implementation
     *
     * @throws MissingConfigurationAttribute
     */
    protected function checkMandatoryAttributes(): void
    {
        foreach ($this->mandatoryAttributes as $mandatoryAttribute) {
            if (!array_key_exists($mandatoryAttribute, $this->config)) {
                throw new MissingConfigurationAttribute(get_class($this) . ": Missing mandatory attribute '$mandatoryAttribute'");
            }
        }
    }
}