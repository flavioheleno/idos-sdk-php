<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

/**
 * Processes Class Endpoint
 */
class Processes extends AbstractProfileEndpoint {

    /**
     * Lists all processes
     *
     * @param  array  $filters
     * @return Array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/processes', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a processe given its slug
     *
     * @param  string $processId
     * @return Array Response
     */
    public function getOne(string $processId) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/processes/%s', $this->userName, $processId)
        );
    }
}
