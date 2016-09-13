<?php

namespace idOS\Endpoint\Profile\Source;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

class Raw extends AbstractSourceEndpoint {
    public function createNew(
        string $collectionName,
        array $data
    ) : array {
        return $this->sendPost(
            sprintf('/profiles/%s/sources/%d/raw', $this->userName, $this->sourceId),
            [],
            [
                'collection' => $collectionName,
                'data'       => $data
            ]
        );
    }

    public function createOrUpdate(
        string $collectionName,
        array $data
    ) : array {
        return $this->sendPut(
            sprintf('/profiles/%s/sources/%d/raw', $this->userName, $this->sourceId),
            [],
            [
                'collection' => $collectionName,
                'data'       => $data
            ]
        );
    }

    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/sources/%d/raw', $this->userName, $this->sourceId),
            $filters
        );
    }

    public function getOne(string $collectionName) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/sources/%d/raw/%s', $this->userName, $this->sourceId, $collectionName)
        );
    }

    public function updateOne(string $collectionName, array $data) : array {
        return $this->sendPatch(
            sprintf('/profiles/%s/sources/%d/raw/%s', $this->userName, $this->sourceId, $collectionName),
            [],
            [
                'data' => $data
            ]
        );
    }

    public function deleteOne(string $collectionName) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/sources/%d/raw/%s', $this->userName, $this->sourceId, $collectionName)
        );
    }

    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/sources/%d/raw', $this->userName, $this->sourceId),
            $filters
        );
    }
}
