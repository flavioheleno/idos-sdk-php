<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

class Features extends AbstractProfileEndpoint {
    private function typeInfer($value) : string {
        if (is_float($value)) {
            return 'double';
        }

        if (is_integer($value)) {
            return 'integer';
        }

        if (is_bool($value)) {
            return 'boolean';
        }

        return 'string';
    }

    public function createNew(
        int $sourceId,
        string $name,
        $value,
        $type = null
    ) : array {
        if ($type === null) {
            $type = $this->typeInfer($value);
        }

        return $this->sendPost(
            sprintf('/profiles/%s/features', $this->userName),
            [],
            [
                'source_id' => $sourceId,
                'name'      => $name,
                'value'     => $value,
                'type'      => $type
            ]
        );
    }

    public function createOrUpdate(
        int $sourceId,
        string $name,
        $value,
        $type = null
    ) : array {
        if ($type === null) {
            $type = $this->typeInfer($value);
        }

        return $this->sendPut(
            sprintf('/profiles/%s/features', $this->userName),
            [],
            [
                'source_id' => $sourceId,
                'name'      => $name,
                'value'     => $value,
                'type'      => $type
            ]
        );
    }

    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/features', $this->userName),
            $filters
        );
    }

    public function getOne(string $featureSlug) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/features/%s', $this->userName, $featureSlug)
        );
    }

    public function updateOne(string $featureSlug, $value, string $type) : array {
        return $this->sendPatch(
            sprintf('/profiles/%s/features/%s', $this->userName, $featureSlug),
            [],
            [
                'value' => $value,
                'type'  => $type
            ]
        );
    }

    public function deleteOne(string $featureSlug) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/features/%s', $this->userName, $featuresSlug)
        );
    }

    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/features', $this->userName),
            $filters
        );
    }
}
