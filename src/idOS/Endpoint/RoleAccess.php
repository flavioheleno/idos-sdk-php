<?php

namespace idOS\Endpoint;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

/**
 * RoleAccess Class Endpoint
 */
class RoleAccess extends AbstractEndpoint {

	/**
     * Creates a new RoleAccess.
     *
     * @param string $role
     * @param string $resource
     * @param int $access
     * @return Array Response
     */
    public function createNew(
       string $role,
       string $attr,
       int $access
    ) : array {
        return $this->sendPost(
            '/access/roles',
            [],
            [
                'role' => $role,
                'resource' => $resource,
                'access' => $access
            ]
        );
    }

	/**
	 * Lists all roleAccesss
	 *
	 * @param  array  $filters
	 * @return Array Response
	 */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            '/access/roles',
            $filters
        );
    }

    /**
     * Retrieves the roleAccess given its roleAccessId
     *
     * @param  int $roleAccessId
     * @return Array Response
     */
    public function getOne(int $roleAccessId) : array {
        return $this->sendGet(
            sprintf('/access/roles/%s', $this->userName, $roleAccessId)
        );
    }

    /**
     * Updates a roleAccess in the given profile.
     *
     * @param string $role
     * @param string $resource
     * @param int $access
     * @return Array Response
     */
    public function updateOne(
        string $role,
        string $attr,
        int $access) : array {
        return $this->sendPatch(
            sprintf('/access/roles/%s', $access),
            [],
            [
                'role' => $role,
                'resource' => $resource,
                'access' => $access
            ]
        );
    }

    /**
     * Deletes a roleAccess given its roleAccessId
     *
     * @param  int $roleAccessId
     * @return Array Response
     */
    public function deleteOne(int $roleAccessId) : array {
        return $this->sendDelete(
            sprintf('/access/roles/%s', $roleAccessId)
        );
    }

 	/**
 	 * Deletes all roleAccesss
     *
 	 * @param  array  $filters
 	 * @return Array Response
 	 */
    public function deleteAll(array $filters = []) : array {
        return $this->sendDelete(
            '/access/roles',
            $filters
        );
    }
}
