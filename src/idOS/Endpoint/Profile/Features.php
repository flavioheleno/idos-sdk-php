<?php

namespace idOS\Endpoint\Profile;

/**
 * Features Class Endpoint.
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

        if (is_array($value)) {
            return 'array';
        }

        return 'string';
    }

    /**
     * Creates a new feature for the given user.
     *
     * @param int        $sourceId
     * @param string     $name
     * @param mixed      $value
     * @param mixed|null $type
     *
     * @return array Response
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
     * @param int        $sourceId
     * @param string     $name
     * @param mixed      $value
     * @param mixed|null $type
     *
     * @return array Response
     */
    public function upsertOne(
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

    public function upsertBulk(array $features) {
        foreach ($features as &$feature) {
            if (empty($feature['type'])) {
                $feature['type'] = $this->typeInfer($feature['value']);
            }
        }

        return $this->sendPut(
            sprintf('/profiles/%s/features/bulk', $this->userName),
            [],
            $features
        );
    }

    /**
     * Lists all features.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/features', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a feature given its slug.
     *
     * @param string $featureSlug
     *
     * @return array Response
     */
    public function getOne(string $featureSlug) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/features/%s', $this->userName, $featureSlug)
        );
    }

    /**
     * Updates a feature given its slug.
     *
     * @param string $featureSlug
     * @param mixed  $value
     * @param string $type
     *
     * @return array Response
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
     * Deletes a feature given its slug.
     *
     * @param string $featureSlug
     *
     * @return array Response
     */
    public function deleteOne(string $featureSlug) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/features/%s', $this->userName, $featuresSlug)
        );
    }

    /**
     * Deletes all features.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/features', $this->userName),
            $filters
        );
    }
}
