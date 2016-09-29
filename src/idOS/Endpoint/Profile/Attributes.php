<?php

namespace idOS\Endpoint\Profile;

use idOS\Endpoint\AbstractEndpoint;

/**
 * Attribute Class Endpoint.
 */
class Attributes extends AbstractEndpoint {
    /**
     * Lists all attributes.
     *
     * @param string $username
     * @param array  $filter
     *
     * @return array Response
     */
    public function listAll($username = '_self', array $filter = []) {
        return $this->get(
            sprintf('/profiles/%s/attributes', $username),
            $filter
        );
    }
}
