<?php

namespace CLIApplication\Test\Api;

use BeSimple\SoapClient\SoapClient;
use BeSimple\SoapClient\SoapClientBuilder;
use BeSimple\SoapClient\SoapResponse;
use BeSimple\SoapCommon\SoapRequest;
use CLIApplication\Api\SoapLocationApi;
use CLIApplication\Configuration\SoapYamlFileConfiguration;
use CLIApplication\Entity\Location;
use CLIApplication\Exception\BadSearchedCityCount;
use CLIApplication\Manager\LocationManager;
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
            $this->getSoapYamlFileConfigurationMock(),
            $this->getLocationManagerMock()
        );
    }

    public function testGetLocationsByCities()
    {
        $allLocations = $this->api->getLocationsByCities(["Test", "London"]);
        foreach ($allLocations as $originalSearched => $locations) {
            foreach ($locations as $location) {
                $this->assertInstanceOf(Location::class, $location);
            }
        }
    }

    public function testGetLocationsByCitiesFail()
    {
        $this->expectException(BadSearchedCityCount::class);
        $allLocations = $this->api->getLocationsByCities(["Test"]);
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
            ->will($this->returnValue($this->getSoapResponseMock()));

        return $clientMock;
    }

    protected function getSoapResponseMock()
    {
        $responseMock = $this->getMockBuilder(SoapResponse::class)
            ->setMethods(["getResponseObject"])
            ->getMock();

        $responseObject = new \stdClass();
        $responseObject->GetUKLocationByTownResult = "
            <NewDataSet>
                <Table>
                    <Town>Little London</Town>
                    <County>East Sussex</County>
                    <PostCode>TN21</PostCode>
                </Table>
                <Table>
                    <Town>Little London</Town>
                    <County>Hampshire</County>
                    <PostCode>RG26</PostCode>
                </Table>
            </NewDataSet>
        ";

        $responseMock
            ->method("getResponseObject")
            ->will($this->returnValue($responseObject));

        return $responseMock;
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
            ->will($this->returnValue("some WSDL"));

        $valueMap = [
            [1, false],
            [2, true]
        ];

        $configurationMock
            ->method("hasLocationGetterAllowedCitiesCount")
            ->will($this->returnValueMap($valueMap));

        return $configurationMock;
    }

    protected function getLocationManagerMock()
    {
        $managerMock = $this->getMockBuilder(LocationManager::class)
            ->setMethods(["create"])
            ->getMock();

        $managerMock
            ->method("create")
            ->will($this->returnValue(new Location()));

        return $managerMock;
    }
}