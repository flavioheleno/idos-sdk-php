<?php

namespace idOS\Endpoint\Profile;

/**
 * Gates Class Endpoint.
 */
class Gates extends AbstractProfileEndpoint {
    /**
     * Creates a new gate for the given user.
     *
     * @param string $name
     * @param bool   $pass
     *
     * @return array Response
     */
    public function createNew(
        string $name,
        bool $pass
    ) : array {

        return $this->sendPost(
            sprintf('/profiles/%s/gates', $this->userName),
            [],
            [
                'name'      => $name,
                'pass'      => $pass
            ]
        );
    }

    /**
     * Tries to update a gate and if it doesnt exists, creates a new gate.
     *
     * @param string $name
     * @param bool   $pass
     *
     * @return array Response
     */
    public function upsertOne(
        string $name,
        bool $pass
    ) : array {

        return $this->sendPut(
            sprintf('/profiles/%s/gates', $this->userName),
            [],
            [
                'name'      => $name,
                'pass'      => $pass
            ]
        );
    }

    /**
     * Lists all gates.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/gates', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a gate given its slug.
     *
     * @param string $gateSlug
     *
     * @return array Response
     */
    public function getOne(string $gateSlug) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/gates/%s', $this->userName, $gateSlug)
        );
    }

    /**
     * Updates a gate given its slug.
     *
     * @param bool $pass
     *
     * @return array Response
     */
    public function updateOne(string $gateSlug, bool $pass) : array {
        return $this->sendPatch(
            sprintf('/profiles/%s/gates/%s', $this->userName, $gateSlug),
            [],
            [
                'pass'     => $pass
            ]
        );
    }

    /**
     * Deletes a gate given its slug.
     *
     * @param string $gateSlug
     *
     * @return array Response
     */
    public function deleteOne(string $gateSlug) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/gates/%s', $this->userName, $gateSlug)
        );
    }

    /**
     * Deletes all gates.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/gates', $this->userName),
            $filters
        );
    }
}
