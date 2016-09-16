<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

class Raw extends AbstractProfileEndpoint {
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

    public function createOrUpdate(
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

    public function updateOne(string $collectionName, array $data) : array {
        return $this->sendPatch(
            sprintf('/profiles/%s/raw/%s', $this->userName, $collectionName),
            [],
            [
                'data' => $data
            ]
        );
    }

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
