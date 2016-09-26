<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

/**
 * References Class Endpoint
 */
class References extends AbstractProfileEndpoint {

	 /**
     * Creates a new reference for the given user.
     *
     * @param  string $name
     * @param  boolean $value
     * @return Array Response
     */
    public function createNew(
        string $name,
        string $value
    ) : array {

        return $this->sendPost(
            sprintf('/profiles/%s/references', $this->userName),
            [],
            [
                'name'      => $name,
                'value'     => $value
            ]
        );
    }

    /**
     * Lists all references
     *
     * @param  array  $filters
     * @return Array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/references', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a reference given its slug
     *
     * @param  string $referenceName
     * @return Array Response
     */
    public function getOne(string $referenceName) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/references/%s', $this->userName, $referenceName)
        );
    }

    /**
     * Updates a reference given its slug
     *
     * @param  boolean $value
     * @return Array Response
     */
    public function updateOne(string $referenceName, string $value) : array {
        return $this->sendPatch(
            sprintf('/profiles/%s/references/%s', $this->userName, $referenceName),
            [],
            [
                'value'     => $value
            ]
        );
    }

    /**
     * Deletes a reference given its slug
     *
     * @param  string $referenceName
     * @return Array Response
     */
    public function deleteOne(string $referenceName) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/references/%s', $this->userName, $referenceName)
        );
    }

    /**
     * Deletes all references
     *
     * @param  array  $filters
     * @return Array Response
     */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/references', $this->userName),
            $filters
        );
    }

}
