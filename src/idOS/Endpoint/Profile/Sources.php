<?php

declare(strict_types = 1);

namespace idOS\Endpoint\Profile;

/**
 * Sources Class Endpoint.
 */
class Sources extends AbstractProfileEndpoint {
    /**
     * Creates a new source for the given username.
     *
     * @param string $name
     * @param string $ipaddr
     * @param array  $tags
     *
     * @return array Response
     */
    public function createNew(
        string $name,
        array $tags
    ) : array {
        $array = [
            'name' => $name,
            'tags' => $tags
        ];

        return $this->sendPost(
            sprintf('/profiles/%s/sources', $this->userName),
            [],
            $array
        );
    }

    /**
     * Lists all sources.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/sources', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves the source given its sourceId.
     *
     * @param int $sourceId
     *
     * @return array Response
     */
    public function getOne(int $sourceId) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/sources/%s', $this->userName, $sourceId)
        );
    }

    /**
     * Updates a source in the given profile.
     *
     * @param int    $sourceId
     * @param string $ipaddr
     * @param string $tags
     *
     * @return array Response
     */
    public function updateOne(int $sourceId, array $tags, string $otpCode = null, string $ipaddr = '') : array {
        $array = [
            'tags' => $tags
        ];

        if ($otpCode !== null) {
            $array['otpCode'] = $otpCode;
        }

        return $this->sendPatch(
            sprintf('/profiles/%s/sources/%s', $this->userName, $sourceId),
            [],
            $array
        );
    }

    /**
     * Deletes a source given its sourceId.
     *
     * @param string $sourceId
     *
     * @return array Response
     */
    public function deleteOne(string $sourceId) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/sources/%s', $this->userName, $sourceId)
        );
    }

    /**
     * Deletes all sources for the given username.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/sources', $this->userName),
            $filters
        );
    }
}
