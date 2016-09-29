<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

/**
 * Features Class Endpoint
 */
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

    /**
     * Creates a new feature for the given user.
     *
     * @param  int    $sourceId
     * @param  string $name
     * @param  $value
     * @param  $type
     * @return Array Response
     */
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

    /**
     * Tries to update a feature and if it doesnt exists, creates a new feature.
     *
     * @param  int    $sourceId
     * @param  string $name
     * @param  $value
     * @param  $type
     * @return Array Response
     */
    public function upsert(
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

    /**
     * Lists all features
     *
     * @param  array  $filters
     * @return Array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/features', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a feature given its slug
     *
     * @param  string $featureSlug
     * @return Array Response
     */
    public function getOne(string $featureSlug) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/features/%s', $this->userName, $featureSlug)
        );
    }

    /**
     * Updates a feature given its slug
     *
     * @param  string $featureSlug
     * @param  $value
     * @param  string $type
     * @return Array Response
     */
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

    /**
     * Deletes a feature given its slug
     *
     * @param  string $featureSlug
     * @return Array Response
     */
    public function deleteOne(string $featureSlug) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/features/%s', $this->userName, $featuresSlug)
        );
    }

    /**
     * Deletes all features
     *
     * @param  array  $filters
     * @return Array Response
     */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/features', $this->userName),
            $filters
        );
    }
}
