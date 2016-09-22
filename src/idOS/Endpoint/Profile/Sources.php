<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

/**
 * Sources Class Endpoint
 */
class Sources extends AbstractProfileEndpoint {

	/**
     * Creates a new source for the given username.
     *
     * @param string $name
     * @param string $ipaddr
     * @param array $tags
     * @return Array Response
     */
    public function createNew(
       string $name,
       string $attr,
       array $tags
    ) : array {
        return $this->sendPost(
            sprintf('/profiles/%s/sources', $this->userName),
            [],
            [
                'name' => $name,
                'ipaddr' => $ipaddr,
                'tags' => $tags
            ]
        );
    }

	/**
	 * Lists all sources
	 *
	 * @param  array  $filters
	 * @return Array Response
	 */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/sources', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves the source given its sourceId
     *
     * @param  int $sourceId
     * @return Array Response
     */
    public function getOne(int $sourceId) : array {
        return $this->sendGet(
            sprintf('/profiles/%s/sources/%s', $this->userName, $sourceId)
        );
    }

    /**
     * Updates a source in the given profile.
     *
     * @param  float $otpCode
     * @param  string $ipaddr
     * @param string $tags
     * @return Array Response
     */
    public function updateOne(string $otpCode, string $ipaddr, float $tags) : array {
        return $this->sendPatch(
            sprintf('/profiles/%s/sources/%s', $this->userName, $ipaddr),
            [],
            [
                'otpCode' => $otpCode,
                'ipaddr' => $ipaddr,
                'tags' => $tags
            ]
        );
    }

    /**
     * Deletes a source given its sourceId
     *
     * @param  string $sourceId
     * @return Array Response
     */
    public function deleteOne(string $sourceId) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/sources/%s', $this->userName, $sourceId)
        );
    }

 	/**
 	 * Deletes all sources for the given username
 	 * @param  array  $filters
 	 * @return Array Response
 	 */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            sprintf('/profiles/%s/sources', $this->userName),
            $filters
        );
    }
}
