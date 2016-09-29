<?php

namespace idOS\Endpoint;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

/**
 * Profiles Class Endpoint
 */
class Profiles extends AbstractEndpoint {

	/**
	 * Lists all Profiles
	 *
	 * @param  array  $filters
	 * @return Array Response
	 */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            '/profiles',
            $filters
        );
    }
}
