<?php

namespace idOS\Endpoint;

/**
 * Single Sign-On Class Endpoint.
 */
class Sso extends AbstractEndpoint {
    /**
     * Creates a new SSO.
     *
     * @param string $providerName
     * @param string $credentialPubKey
     * @param string $accessToken
     * @param string $tokenSecret
     */
    public function createNew(
        $providerName,
        $credentialPubKey,
        $accessToken,
        $tokenSecret = ''
    ) {

        $array = [
            'provider'     => $providerName,
            'access_token' => $accessToken,
            'credential'   => $credentialPubKey
        ];

        if (! empty($tokenSecret)) {
            $array['token_secret'] = $tokenSecret;
        }

        return $this->sendPost(
            '/sso',
            [],
            $array
        );
    }

    /**
     * Lists all SSO.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
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
    public function getOne($providerName) {
        return $this->sendGet(
            sprintf('/sso/%s', $providerName)
        );
    }
}
