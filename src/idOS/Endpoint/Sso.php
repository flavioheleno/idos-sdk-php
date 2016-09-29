<?php

namespace idOS\Endpoint;

/**
 * Sso Class Endpoint.
 */
class Sso extends AbstractEndpoint {
    /**
     * Creates a new Sso.
     *
     * @param string $key
     * @param string $secret
     * @param string $ipAddress
     * @param string $accessToken
     * @param string $credentialPubKey
     */
    public function createNew(
        string $key,
        string $secret,
        string $ipAddress,
        string $accessToken,
        string $credentialPubKey
    ) : array {
        return $this->sendPost(
            '/sso',
            [],
            [
                'key'              => $key,
                'secret'           => $secret,
                'ipAddress'        => $ipAddress,
                'accessToken'      => $accessToken,
                'credentialPubKey' => $credentialPubKey
            ]
        );
    }

    /**
     * Lists all sso.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) : array {
        return $this->sendGet(
            '/sso',
            $filters
        );
    }

    /**
     * Retrieves the roleAccess given its providerName.
     *
     * @param string $providerName
     *
     * @return array Response
     */
    public function getOne(string $providerName) : array {
        return $this->sendGet(
            sprintf('/sso/%s', $providerName)
        );
    }
}
