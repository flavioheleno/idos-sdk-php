<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

/**
 * Raw Class Endpoint
 */
class Raw extends AbstractProfileEndpoint {

    /**
     * Creates a new raw data for the given source.
     *
     * @param  int    $sourceId
     * @param  string $collectionName
     * @param  array  $data
     * @return Array Response
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
     * @param  int    $sourceId
     * @param  string $collectionName
     * @param  array  $data
     * @return Array Response
     */
    public function upsert(
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
     * Lists all raw data
     *
     * @param  array  $filters
     * @return Array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/raw', $this->userName),
            $filters
        );
    }

    public function getOne(string $collectionName) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/raw/%s', $this->userName, $collectionName)
        );
    }

    /**
     * Updates a raw data in the given source.
     *
     * @param  string $collectionName
     * @param  array  $data
     * @return Array Response
     */
    public function updateOne(string $collectionName, array $data) : array {
        return $this->sendPatch(
            sprintf('/profiles/%s/raw/%s', $this->userName, $collectionName),
            [],
            [
                'data' => $data
            ]
        );
    }

    /**
     * Deletes a raw data given its collectionName
     *
     * @param  string $collectionName
     * @return Array Response
     */
    public function deleteOne(string $collectionName) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/raw/%s', $this->userName, $collectionName)
        );
    }

    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/raw', $this->userName),
            $filters
        );
    }
}
