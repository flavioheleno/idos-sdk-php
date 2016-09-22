<?php

namespace idOS\Endpoint;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

/**
 * Tokens Class Endpoint
 */
class Tokens extends AbstractEndpoint {

	/**
	 * Exchange a user token given a company slug
	 *
	 * @param  string $companySlug
	 * @return Array Response
	 */
    public function exchange(string $companySlug) : array {
        return $this->sendPost(
            '/token',
            [],
            [
                'slug' => $companySlug
            ]
        );
    }
}
