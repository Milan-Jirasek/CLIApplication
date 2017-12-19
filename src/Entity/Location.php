<?php

namespace CLIApplication\Entity;

/**
 * Class Location
 *
 * @package CLIApplication\Entity
 */
class Location
{
    /**
     * @var string
     */
    private $city = "";

    /**
     * @var string
     */
    private $zip = "";

    /**
     * City getter
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * City setter
     *
     * @param string $city
     * @return Location
     */
    public function setCity(string $city): Location
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Zip getter
     *
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * Zip setter
     *
     * @param string $zip
     * @return Location
     */
    public function setZip(string $zip): Location
    {
        $this->zip = $zip;

        return $this;
    }


}