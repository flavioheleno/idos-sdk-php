<?php

declare(strict_types = 1);

namespace idOS\Endpoint\Profile;

/**
 * Processes Class Endpoint.
 */
class Processes extends AbstractProfileEndpoint {
    /**
     * Lists all processes.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/processes', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a processe given its slug.
     *
     * @param string $processId
     *
     * @return array Response
     */
    public function getOne(string $processId) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/processes/%s', $this->userName, $processId)
        );
    }
}
