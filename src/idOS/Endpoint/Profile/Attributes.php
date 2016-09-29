<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

/**
 * Attribute Class Endpoint
 */
class Attributes extends AbstractEndpoint {
	/**
	 * Lists all attributes
	 *
	 * @param  string $username
	 * @param  array  $filter
	 * @return Array Response
	 */
    public function listAll($username = '_self', array $filter = []) {
        return $this->get(
            sprintf('/profiles/%s/attributes', $username),
            $filter
        );
    }
}
