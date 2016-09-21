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
     * @param  string $name
     * @param  string $reference
     * @return Array Response
     */
    public function createNew(
        string $name,
        string $reference
    ) : array {

        return $this->sendPost(
            sprintf('/profiles/%s/warnings', $this->userName),
            [],
            [
                'name'      => $name,
                'reference' => $reference
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
     * @param  string $warningSlug
     * @return Array Response
     */
    public function getOne(string $warningSlug) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/warnings/%s', $this->userName, $warningSlug)
        );
    }

    /**
     * Deletes a warning given its slug
     *
     * @param  string $warningSlug
     * @return Array Response
     */
    public function deleteOne(string $warningSlug) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/warnings/%s', $this->userName, $warningsSlug)
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
