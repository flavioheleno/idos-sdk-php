<?php

namespace idOS\Endpoint\Profile;

/**
 * Warnings Class Endpoint.
 */
class Warnings extends AbstractProfileEndpoint {
    /**
     * Creates a new warning for the given user.
     *
     * @param string $slug
     * @param string $attribute
     *
     * @return array Response
     */
    public function createNew(
        $slug,
        $attribute
    ) {

        return $this->sendPost(
            sprintf('/profiles/%s/warnings', $this->userName),
            [],
            [
                'slug'      => $slug,
                'attribute' => $attribute
            ]
        );
    }

    /**
     * Lists all warnings.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/warnings', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a warning given its slug.
     *
     * @param string $slug
     *
     * @return array Response
     */
    public function getOne($slug) {
        return $this->sendGet(
            sprintf('/profiles/%s/warnings/%s', $this->userName, $slug)
        );
    }

    /**
     * Deletes a warning given its slug.
     *
     * @param string $slug
     *
     * @return array Response
     */
    public function deleteOne($slug) {
        return $this->sendDelete(
            sprintf('/profiles/%s/warnings/%s', $this->userName, $slug)
        );
    }

    /**
     * Deletes all warnings.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) {
        return $this->sendDelete(
            sprintf('/profiles/%s/warnings', $this->userName),
            $filters
        );
    }
}
