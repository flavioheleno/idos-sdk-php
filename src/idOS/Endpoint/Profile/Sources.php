<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

/**
 * Sources Class Endpoint
 */
class Sources extends AbstractProfileEndpoint {
	/**
	 * Lists all sources
	 *
	 * @param  array  $filters
	 * @return Json response
	 */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/sources', $this->userName),
            $filters
        );
    }
}
