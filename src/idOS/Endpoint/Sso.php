<?php

namespace idOS\Endpoint;

/**
 * Single Sign-On Class Endpoint.
 */
class Sso extends AbstractEndpoint {
    /**
     * Creates a new SSO.
     *
     * @param string $key
     * @param string $secret
     * @param string $accessToken
     * @param string $tokenSecret
     * @param string $credentialPubKey
     */
    public function createNew(
        string $key,
        string $secret,
        string $accessToken,
        string $tokenSecret,
        string $credentialPubKey
    ) : array {
        return $this->sendPost(
            '/sso',
            [],
            [
                'key'              => $key,
                'secret'           => $secret,
                'accessToken'      => $accessToken,
                'tokenSecret'      => $tokenSecret,
                'credentialPubKey' => $credentialPubKey
            ]
        );
    }

    /**
     * Lists all SSO.
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
     * Retrieves a providerName SSO availability status.
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
