<?php

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
    public function listAll(array $filter = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/attributes', $this->userName),
            $filter
        );
    }

    /**
     * Creates a new attribute for the given user.
     *
     * @param string $name
     * @param string $value
     * @param float  $support
     *
     * @return array Response
     */
    public function createNew(
        string $name,
        string $value,
        float $support
    ) : array {
        return $this->sendPost(
            sprintf('/profiles/%s/attributes', $this->userName),
            [],
            [
                'name'      => $name,
                'value'     => $value,
                'support'   => $support
            ]
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

    /**
     * Deletes an attribute given its slug.
     *
     * @param string $attributeName
     *
     * @return array Response
     */
    public function deleteOne(string $attributeName) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/attributes/%s', $this->userName, $attributeName)
        );
    }

    /**
     * Deletes all attributes.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/attributes', $this->userName),
            $filters
        );
    }
}
