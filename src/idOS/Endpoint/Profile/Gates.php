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
        $name,
        $pass
    ) {

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
        $name,
        $pass
    ) {

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
    public function listAll(array $filters = []) {
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
    public function getOne($gateSlug) {
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
    public function updateOne($gateSlug, $pass) {
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
    public function deleteOne($gateSlug) {
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
    public function deleteAll(array $filters = []) {
        return $this->sendDelete(
            sprintf('/profiles/%s/gates', $this->userName),
            $filters
        );
    }
}
