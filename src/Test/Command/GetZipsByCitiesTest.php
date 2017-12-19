<?php

namespace CLIApplication\Test\Command;

use CLIApplication\Api\LocationApiInterface;
use CLIApplication\Command\GetZipsByCities;
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
            "cities" => "Hokus Pokus London"
        ]);

        $output = $commandTester->getDisplay();
        $this->assertCount("City: Hokus, Zip: unknown", $output);
    }

    protected function getApiMock()
    {
        return $this->getMockBuilder(LocationApiInterface::class)
            ->getMock();
    }
}