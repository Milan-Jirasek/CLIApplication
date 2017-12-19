<?php

namespace CLIApplication\Command;

use CLIApplication\Api\LocationApiInterface;
use CLIApplication\Entity\Location;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetZipsByCities
 *
 * @package CLIApplication\Command
 */
class GetZipsByCities extends Command
{
    /**
     * @var LocationApiInterface;
     */
    protected $api;

    /**
     * GetZipsByCities constructor.
     *
     * @param null $name
     * @param LocationApiInterface $api
     */
    public function __construct($name = null, LocationApiInterface $api)
    {
        parent::__construct($name);
        $this->api = $api;
    }

    protected function configure()
    {
        $this->setName("api:location:get-zip")
            ->setDescription("Get zip codes by cities' names")
            ->addArgument(
                "cities",
                InputArgument::IS_ARRAY,
                "Array of cities"
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cities = $input->getArgument("cities");
        $allLocations = $this->api->getLocationsByCities($cities);

        $output->writeln([
            'ZIP CODES BY CITIES',
        ]);
        /** @var Location $location */
        foreach ($allLocations as $originalSearched => $locations) {
            $output->writeln([
                "",
                "Originally searched: $originalSearched",
                '==================='
            ]);
            foreach ($locations as $location) {
                $output->writeln("City: {$location->getCity()}, County:{$location->getCounty()}, ZIP: {$location->getZip()}");
            }
        }
    }
}