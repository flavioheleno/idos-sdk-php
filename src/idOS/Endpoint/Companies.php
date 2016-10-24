<?php

namespace idOS\Endpoint;

/**
 * Companies Class Endpoint.
 */
class Companies extends AbstractEndpoint {
    /**
     * Lists all Companies.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            '/companies',
            $filters
        );
    }
}
