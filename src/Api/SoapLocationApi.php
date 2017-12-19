<?php

namespace CLIApplication\Api;

use BeSimple\SoapClient\SoapClient;
use BeSimple\SoapClient\SoapClientBuilder;
use BeSimple\SoapClient\SoapClientOptionsBuilder;
use BeSimple\SoapCommon\SoapOptionsBuilder;
use BeSimple\SoapCommon\SoapRequest;
use CLIApplication\Configuration\LocationConfigurationInterface;
use CLIApplication\Configuration\SoapYamlFileConfiguration;

/**
 * Class SoapLocationApi
 *
 * @package CLIApplication\Api
 */
class SoapLocationApi implements LocationApiInterface
{
    /**
     * @var SoapClient
     */
    protected $soapClient;
    /**
     * @var SoapRequest
     */
    protected $soapRequest;

    /**
     * @var SoapYamlFileConfiguration
     */
    protected $configuration;

    /**
     * SoapLocationApi constructor.
     *
     * @param SoapClientBuilder $soapClientBuilder
     * @param SoapRequest $soapRequest
     * @param SoapYamlFileConfiguration $configuration
     */
    public function __construct(SoapClientBuilder $soapClientBuilder, SoapRequest $soapRequest, SoapYamlFileConfiguration $configuration)
    {
        $this->soapRequest = $soapRequest;
        $this->configuration = $configuration;
        $this->soapClient = $this->createSoapClient($soapClientBuilder);
    }

    /**
     * Create SoapClient
     *
     * @param SoapClientBuilder $builder
     * @return SoapClient
     */
    protected function createSoapClient(SoapClientBuilder $builder): SoapClient
    {
        return $builder->build(
            SoapClientOptionsBuilder::createWithDefaults(),
            SoapOptionsBuilder::createWithDefaults($this->configuration->getWsdl())
        );
    }

    /**
     * Return array of Locations objects
     *
     * @param array $cities
     * @return array
     */
    public function getLocationsByCities(array $cities): array
    {
        // TODO: Implement getLocationsByCities() method.
    }
}