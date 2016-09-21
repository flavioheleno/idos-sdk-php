<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

/**
 * References Class Endpoint
 */
class References extends AbstractProfileEndpoint {
	/**
	 * Lists all sources
	 *
	 * @param  array  $filters
	 * @return Array Response
	 */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/references', $this->userName),
            $filters
        );
    }
}
