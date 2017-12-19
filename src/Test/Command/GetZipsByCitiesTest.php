<?php

namespace CLIApplication\Test\Command;

use CLIApplication\Api\LocationApiInterface;
use CLIApplication\Command\GetZipsByCities;
use CLIApplication\Entity\Location;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GetZipsByCitiesTest extends TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new GetZipsByCities(null, $this->getApiMock()));

        $command = $application->find("api:location:get-zip");
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            "command" => $command->getName(),
            "cities" => ["Hokus", "Pokus", "London"]
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains("ZIP CODES BY CITIES", $output);
    }

    protected function getApiMock()
    {
        $apiMock = $this->getMockBuilder(LocationApiInterface::class)
            ->setMethods(["getLocationsByCities"])
            ->getMock();

        $returnedLocation = new Location();
        $returnedLocation
            ->setCity("Hokus")
            ->setZip("ZIP")
            ->setCounty("BeautifulCounty");

        $apiMock
            ->method("getLocationsByCities")
            ->will($this->returnValue(["Hokus" => [$returnedLocation]]));

        return $apiMock;
    }
}