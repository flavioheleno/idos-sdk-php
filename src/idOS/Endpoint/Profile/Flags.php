<?php

namespace idOS\Endpoint\Profile;

/**
 * Flags Class Endpoint.
 */
class Flags extends AbstractProfileEndpoint {
    /**
     * Creates a new flag for the given user.
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
        assert(
            is_string($slug),
            new \RuntimeException(
                sprintf('Parameter "$slug" should be a string. (%s)', $slug)
            )
        );
        assert(
            is_string($attribute),
            new \RuntimeException(
                sprintf('Parameter "$attribute" should be a string. (%s)', $attribute)
            )
        );

        return $this->sendPost(
            sprintf('/profiles/%s/flags', $this->userName),
            [],
            [
                'slug'      => $slug,
                'attribute' => $attribute
            ]
        );
    }

    /**
     * Lists all flags.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll($filters = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/flags', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a flag given its slug.
     *
     * @param string $slug
     *
     * @return array Response
     */
    public function getOne($slug) {
        assert(
            is_string($slug),
            new \RuntimeException(
                sprintf('Parameter "$slug" should be a string. (%s)', $slug)
            )
        );

        return $this->sendGet(
            sprintf('/profiles/%s/flags/%s', $this->userName, $slug)
        );
    }

    /**
     * Deletes a flag given its slug.
     *
     * @param string $slug
     *
     * @return array Response
     */
    public function deleteOne($slug) {
        assert(
            is_string($slug),
            new \RuntimeException(
                sprintf('Parameter "$slug" should be a string. (%s)', $slug)
            )
        );

        return $this->sendDelete(
            sprintf('/profiles/%s/flags/%s', $this->userName, $slug)
        );
    }

    /**
     * Deletes all flags.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll($filters = []) {
        return $this->sendDelete(
            sprintf('/profiles/%s/flags', $this->userName),
            $filters
        );
    }
}
