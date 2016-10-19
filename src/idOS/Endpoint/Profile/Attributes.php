<?php

declare(strict_types = 1);

namespace idOS\Endpoint\Profile;

/**
 * Attribute Class Endpoint.
 */
class Attributes extends AbstractProfileEndpoint {
    /**
     * Lists all attributes.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/attributes', $this->userName),
            $filter
        );
    }

    /**
     * Retrieves an attribute given its slug.
     *
     * @param string $attributeName
     *
     * @return array Response
     */
    public function getOne(string $attributeName) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/attributes/%s', $this->userName, $attributeName)
        );
    }
}
