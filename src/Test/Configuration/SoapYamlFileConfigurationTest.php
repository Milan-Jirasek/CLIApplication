<?php

namespace CLIApplication\Test\Configuration;

use CLIApplication\Configuration\SoapYamlFileConfiguration;
use CLIApplication\Exception\MissingConfigurationAttribute;
use PHPUnit\Framework\TestCase;

class SoapYamlFileConfigurationTest extends TestCase
{
    /** @var  SoapYamlFileConfiguration */
    protected $configuration;

    public function setUp()
    {
        $this->configuration = new SoapYamlFileConfiguration(__DIR__ . DIRECTORY_SEPARATOR . "test_soap_config.yml");
    }

    public function testWsdl()
    {
        $this->assertEquals("test wsdl", $this->configuration->getWsdl());
    }

    public function testHasLocationGetterAllowedCitiesCount()
    {
        $this->assertTrue($this->configuration->hasLocationGetterAllowedCitiesCount(10));
        $this->assertFalse($this->configuration->hasLocationGetterAllowedCitiesCount(100));
    }

    public function testBadConfig()
    {
        $this->expectException(MissingConfigurationAttribute::class);
        $configuration = new SoapYamlFileConfiguration(__DIR__ . DIRECTORY_SEPARATOR . "test_soap_config_bad.yml");
    }
}