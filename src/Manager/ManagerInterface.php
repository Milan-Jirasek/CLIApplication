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
     * @param array $data
     * @return mixed
     */
    public function create(array $data = []);
}