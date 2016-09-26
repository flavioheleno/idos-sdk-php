<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

/**
 * Warnings Class Endpoint
 */
class Warnings extends AbstractProfileEndpoint {

    /**
     * Creates a new warning for the given user.
     *
     * @param  string $slug
     * @param  string $attribute
     * @return Array Response
     */
    public function createNew(
        string $slug,
        string $attribute
    ) : array {

        return $this->sendPost(
            sprintf('/profiles/%s/warnings', $this->userName),
            [],
            [
                'slug'      => $slug,
                'attribute' => $attribute
            ]
        );
    }

    /**
     * Lists all warnings
     *
     * @param  array  $filters
     * @return Array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/warnings', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a warning given its slug
     *
     * @param  string $slug
     * @return Array Response
     */
    public function getOne(string $slug) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/warnings/%s', $this->userName, $slug)
        );
    }

    /**
     * Deletes a warning given its slug
     *
     * @param  string $slug
     * @return Array Response
     */
    public function deleteOne(string $slug) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/warnings/%s', $this->userName, $slug)
        );
    }

    /**
     * Deletes all warnings
     *
     * @param  array  $filters
     * @return Array Response
     */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/warnings', $this->userName),
            $filters
        );
    }
}
