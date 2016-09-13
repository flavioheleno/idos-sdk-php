<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

class Attributes extends AbstractEndpoint {
    public function listAll($username = '_self', array $filter = []) {
        return $this->get(
            sprintf('/profiles/%s/attributes', $username),
            $filter
        );
    }
}
