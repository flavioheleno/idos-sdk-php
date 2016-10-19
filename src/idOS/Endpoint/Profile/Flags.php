<?php

namespace idOS\Endpoint\Profile;

/**
 * Flags Class Endpoint.
 */
class Flags extends AbstractProfileEndpoint {
    /**
     * Creates a new flag for the given user.
     *
     * @param string $slug
     * @param string $attribute
     *
     * @return array Response
     */
    public function createNew(
        string $slug,
        string $attribute
    ) : array {

        return $this->sendPost(
            sprintf('/profiles/%s/flags', $this->userName),
            [],
            [
                'slug'      => $slug,
                'attribute' => $attribute
            ]
        );
    }

    /**
     * Lists all flags.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/flags', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a flag given its slug.
     *
     * @param string $slug
     *
     * @return array Response
     */
    public function getOne(string $slug) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/flags/%s', $this->userName, $slug)
        );
    }

    /**
     * Deletes a flag given its slug.
     *
     * @param string $slug
     *
     * @return array Response
     */
    public function deleteOne(string $slug) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/flags/%s', $this->userName, $slug)
        );
    }

    /**
     * Deletes all flags.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/flags', $this->userName),
            $filters
        );
    }
}
