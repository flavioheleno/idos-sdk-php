<?php

namespace idOS\Endpoint\Profile;

/**
 * Raw Class Endpoint.
 */
class Raw extends AbstractProfileEndpoint {
    /**
     * Creates a new raw data for the given source.
     *
     * @param int    $sourceId
     * @param string $collectionName
     * @param array  $data
     *
     * @return array Response
     */
    public function createNew(
        int $sourceId,
        string $collectionName,
        array $data
    ) : array {
        return $this->sendPost(
            sprintf('/profiles/%s/raw', $this->userName),
            [],
            [
                'source_id'  => $sourceId,
                'collection' => $collectionName,
                'data'       => $data
            ]
        );
    }

    /**
     * Tries to update a raw data and if it doesnt exists, creates a new raw data.
     *
     * @param int    $sourceId
     * @param string $collectionName
     * @param array  $data
     *
     * @return array Response
     */
    public function upsertOne(
        int $sourceId,
        string $collectionName,
        array $data
    ) : array {
        return $this->sendPut(
            sprintf('/profiles/%s/raw', $this->userName),
            [],
            [
                'source_id'  => $sourceId,
                'collection' => $collectionName,
                'data'       => $data
            ]
        );
    }

    /**
     * Lists all raw data.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/raw', $this->userName),
            $filters
        );
    }

    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/raw', $this->userName),
            $filters
        );
    }
}
