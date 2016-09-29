<?php

namespace idOS\Endpoint\Profile;

/**
 * Scores Class Endpoint.
 */
class Scores extends AbstractProfileEndpoint {
    /**
     * Creates a new score for the given source.
     *
     * @param string $attribute
     * @param string $name
     * @param float  $value
     *
     * @return array Response
     */
    public function createNew(
        string $attribute,
        string $name,
        float $value
    ) : array {
        return $this->sendPost(
            sprintf('/profiles/%s/scores', $this->userName),
            [],
            [
                'attribute' => $attribute,
                'name'      => $name,
                'value'     => $value
            ]
        );
    }

    /**
     * Tries to update a score and if it doesnt exists, creates a new score.
     *
     * @param string $attribute
     * @param string $name
     * @param float  $value
     *
     * @return array Response
     */
    public function upsertOne(
        string $attribute,
        string $name,
        float $value
    ) : array {
        if ($type === null) {
            $type = $this->typeInfer($value);
        }

        return $this->sendPut(
            sprintf('/profiles/%s/scores', $this->userName),
            [],
            [
                'attribute' => $attribute,
                'name'      => $name,
                'value'     => $value
            ]
        );
    }

    /**
     * Lists all scores.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/scores', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves the score given its name.
     *
     * @param string $name
     *
     * @return
     */
    public function getOne(string $name) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/scores/%s', $this->userName, $name)
        );
    }

    /**
     * Updates a score in the given profile.
     *
     * @param string $attribute
     * @param string $name
     * @param float  $value
     *
     * @return array Response
     */
    public function updateOne(string $attribute, string $name, float $value) : array {
        return $this->sendPatch(
            sprintf('/profiles/%s/scores/%s', $this->userName, $name),
            [],
            [
                'attribute' => $attribute,
                'value'     => $value
            ]
        );
    }

    /**
     * Deletes a score given its name.
     *
     * @param string $name
     *
     * @return array Response
     */
    public function deleteOne(string $name) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/scores/%s', $this->userName, $name)
        );
    }

    /**
     * Deletes all scores for the given username.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/scores', $this->userName),
            $filters
        );
    }
}
