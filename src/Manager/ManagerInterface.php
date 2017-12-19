<?php

namespace CLIApplication\Manager;

/**
 * Interface ManagerInterface
 *
 * @package CLIApplication\Manager
 */
interface ManagerInterface
{
    /**
     * Create object based on concrete implementation
     *
     * @return mixed
     */
    public function create();
}