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
     * @param string $confidenceLevel
     *
     * @return array Response
     */
    public function createNew(
        $name,
        $pass,
        $confidenceLevel = ''
    ) {
        assert(
            is_string($name),
            sprintf('Parameter "$name" should be a string. (%s)', $name)
        );
        assert(
            is_bool($pass),
            sprintf('Parameter "$pass" should be a boolean. (%s)', $pass)
        );

        $array = [
            'name'      => $name,
            'pass'      => $pass
        ];

        if (! empty($confidenceLevel)) {
            assert(
                is_string($confidenceLevel),
                sprintf('Parameter "$confidenceLevel" should be a string. (%s)', $confidenceLevel)
            );
            $array['confidence_level'] = $confidenceLevel;
        }

        return $this->sendPost(
            sprintf('/profiles/%s/gates', $this->userName),
            [],
            $array
        );
    }

    /**
     * Tries to update a gate and if it doesnt exists, creates a new gate.
     *
     * @param string $name
     * @param bool   $pass
     * @param string $confidenceLevel
     *
     * @return array Response
     */
    public function upsertOne(
        $name,
        $pass,
        $confidenceLevel = ''
    ) {
        assert(
            is_string($name),
            sprintf('Parameter "$name" should be a string. (%s)', $name)
        );
        assert(
            is_bool($pass),
            sprintf('Parameter "$pass" should be a boolean. (%s)', $pass)
        );

        $array = [
            'name'      => $name,
            'pass'      => $pass
        ];

        if (! empty($confidenceLevel)) {
            assert(
                is_string($confidenceLevel),
                sprintf('Parameter "$confidenceLevel" should be a string. (%s)', $confidenceLevel)
            );
            $array['confidence_level'] = $confidenceLevel;
        }

        return $this->sendPut(
            sprintf('/profiles/%s/gates', $this->userName),
            [],
            $array
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
        assert(
            is_string($gateSlug),
            sprintf('Parameter "$gateSlug" should be a string. (%s)', $gateSlug)
        );

        return $this->sendGet(
            sprintf('/profiles/%s/gates/%s', $this->userName, $gateSlug)
        );
    }

    /**
     * Updates a gate given its slug.
     *
     * @param string $gateSlug
     * @param bool $pass
     *
     * @return array Response
     */
    public function updateOne($gateSlug, $pass) {
        assert(
            is_string($gateSlug),
            sprintf('Parameter "$gateSlug" should be a string. (%s)', $gateSlug)
        );
        assert(
            is_bool($pass),
            sprintf('Parameter "$pass" should be a boolean. (%s)', $pass)
        );

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
        assert(
            is_string($gateSlug),
            sprintf('Parameter "$gateSlug" should be a string. (%s)', $gateSlug)
        );

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
