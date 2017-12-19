<?php

namespace CLIApplication\Test\Api;

use BeSimple\SoapClient\SoapClient;
use BeSimple\SoapClient\SoapClientBuilder;
use BeSimple\SoapCommon\SoapRequest;
use CLIApplication\Api\SoapLocationApi;
use CLIApplication\Configuration\SoapYamlFileConfiguration;
use CLIApplication\Entity\Location;
use PHPUnit\Framework\TestCase;

class SoapLocationApiTest extends TestCase
{
    /** @var  SoapLocationApi */
    protected $api;

    public function setUp()
    {
        $this->api = new SoapLocationApi(
            $this->getSoapBuilderMock(),
            $this->getSoapRequestMock(),
            $this->getSoapYamlFileConfigurationMock()
        );
    }

    public function testGetLocationsByCities()
    {
        $locations = $this->api->getLocationsByCities(["Testík", "Magic", "London"]);
        foreach ($locations as $location) {
            $this->assertInstanceOf(Location::class, $location);
        }
    }

    protected function getSoapBuilderMock()
    {
        $builderMock = $this->getMockBuilder(SoapClientBuilder::class)
            ->getMock();

        $builderMock
            ->method("build")
            ->will($this->returnValue($this->getSoapClientMock()));

        return $builderMock;
    }

    protected function getSoapClientMock()
    {
        $clientMock = $this->getMockBuilder(SoapClient::class)
            ->disableOriginalConstructor()
            ->setMethods(["soapCall"])
            ->getMock();

        $clientMock
            ->method("soapCall")
            ->will($this->returnValue("TODO"));

        return $clientMock;
    }

    protected function getSoapRequestMock()
    {
        return $this->getMockBuilder(SoapRequest::class)
            ->getMock();
    }

    protected function getSoapYamlFileConfigurationMock()
    {
        $configurationMock = $this->getMockBuilder(SoapYamlFileConfiguration::class)
            ->disableOriginalConstructor()
            ->setMethods(["getWsdl", "hasLocationGetterAllowedCitiesCount"])
            ->getMock();

        $configurationMock
            ->method("getWsdl")
            ->will($this->returnValue("http://www.webservicex.net/uklocation.asmx?WSDL"));

        $configurationMock
            ->method("hasLocationGetterAllowedCitiesCount")
            ->with(1)
            ->will($this->returnValue(false));

        $configurationMock
            ->method("hasLocationGetterAllowedCitiesCount")
            ->with(2)
            ->will($this->returnValue(true));

        return $configurationMock;
    }
}