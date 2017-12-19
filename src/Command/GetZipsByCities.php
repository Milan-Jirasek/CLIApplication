<?php

namespace CLIApplication\Command;

use CLIApplication\Api\LocationApiInterface;
use Symfony\Component\Console\Command\Command;

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
            ->setDescription("Get zip codes by cities' names");
    }
}