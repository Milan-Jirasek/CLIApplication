<?php

namespace CLIApplication\Api;

use BeSimple\SoapClient\SoapClient;
use BeSimple\SoapClient\SoapClientBuilder;
use BeSimple\SoapClient\SoapClientOptionsBuilder;
use BeSimple\SoapCommon\SoapOptionsBuilder;
use BeSimple\SoapCommon\SoapRequest;
use CLIApplication\Configuration\SoapYamlFileConfiguration;
use CLIApplication\Exception\BadSearchedCityCount;
use CLIApplication\Manager\ManagerInterface;

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
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * SoapLocationApi constructor.
     *
     * @param SoapClientBuilder $soapClientBuilder
     * @param SoapRequest $soapRequest
     * @param SoapYamlFileConfiguration $configuration
     * @param ManagerInterface $manager
     */
    public function __construct(SoapClientBuilder $soapClientBuilder, SoapRequest $soapRequest, SoapYamlFileConfiguration $configuration, ManagerInterface $manager)
    {
        $this->soapRequest = $soapRequest;
        $this->configuration = $configuration;
        $this->manager = $manager;
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
     * Return locations array
     *
     * @param array $cities
     * @return array
     * @throws BadSearchedCityCount
     */
    public function getLocationsByCities(array $cities): array
    {
        if (!$this->configuration->hasLocationGetterAllowedCitiesCount(count($cities))) {
            throw new BadSearchedCityCount(get_class($this) . ": Unallowed cities' search count [count: " . count($cities) . "]");
        }

        $locations = [];
        foreach ($cities as $city) {
            $this->soapRequest->Town = $city;
            $response = $this->soapClient->soapCall("GetUKLocationByTown", [$this->soapRequest]);
            $xml = simplexml_load_string($response->getResponseObject()->GetUKLocationByTownResult);

            foreach ($xml->Table as $element) {
                $locations[$city][] = $this->manager->create([
                    "city" => $element->Town,
                    "zip" => $element->PostCode,
                    "county" => $element->County,
                ]);
            }
        }

        return $locations;
    }
}