<?php

declare(strict_types = 1);

namespace idOS\Endpoint\Profile;

/**
 * Candidate Class Endpoint.
 */
class Candidates extends AbstractProfileEndpoint {
    /**
     * Lists all attribute candidates.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/candidates', $this->userName),
            $filter
        );
    }

    /**
     * Creates a new attribute candidate for the given user.
     *
     * @param string $attribute
     * @param string $value
     * @param float  $support
     *
     * @return array Response
     */
    public function createNew(
        string $attribute,
        string $value,
        float $support
    ) : array {
        return $this->sendPost(
            sprintf('/profiles/%s/candidates', $this->userName),
            [],
            [
                'attribute' => $attribute,
                'value'     => $value,
                'support'   => $support
            ]
        );
    }

    /**
     * Deletes all attribute candidates.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/candidates', $this->userName),
            $filters
        );
    }
}
