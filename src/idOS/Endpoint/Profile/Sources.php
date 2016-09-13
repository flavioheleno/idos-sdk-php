<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

class Sources extends AbstractProfileEndpoint {
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/sources', $this->userName),
            $filters
        );
    }
}
