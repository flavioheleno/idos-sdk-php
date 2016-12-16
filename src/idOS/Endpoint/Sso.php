<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint;

/**
 * Single Sign-On Class Endpoint.
 */
class Sso extends AbstractEndpoint
{
    /**
     * Creates a new SSO.
     *
     * @param string $providerName
     * @param string $credentialPubKey
     * @param string $accessToken
     * @param string $tokenSecret
     * @param string $signupHash
     */
    public function createNew($providerName, $credentialPubKey, $accessToken, $tokenSecret = '', $signupHash = '')
    {
        if (! is_string($providerName)) {
            throw new \InvalidArgumentException('Argument $providerName passed to createNew() must be of the type string, ' . (gettype($providerName) == 'object' ? get_class($providerName) : gettype($providerName)) . ' given');
        }
        if (! is_string($credentialPubKey)) {
            throw new \InvalidArgumentException('Argument $credentialPubKey passed to createNew() must be of the type string, ' . (gettype($credentialPubKey) == 'object' ? get_class($credentialPubKey) : gettype($credentialPubKey)) . ' given');
        }
        if (! is_string($accessToken)) {
            throw new \InvalidArgumentException('Argument $accessToken passed to createNew() must be of the type string, ' . (gettype($accessToken) == 'object' ? get_class($accessToken) : gettype($accessToken)) . ' given');
        }
        if (! is_string($tokenSecret)) {
            throw new \InvalidArgumentException('Argument $tokenSecret passed to createNew() must be of the type string, ' . (gettype($tokenSecret) == 'object' ? get_class($tokenSecret) : gettype($tokenSecret)) . ' given');
        }
        if (! is_string($signupHash)) {
            throw new \InvalidArgumentException('Argument $signupHash passed to createNew() must be of the type string, ' . (gettype($signupHash) == 'object' ? get_class($signupHash) : gettype($signupHash)) . ' given');
        }
        $array = ['provider' => $providerName, 'access_token' => $accessToken, 'credential' => $credentialPubKey];
        if (! empty($tokenSecret)) {
            $array['token_secret'] = $tokenSecret;
        }
        if (! empty($signupHash)) {
            $array['signup_hash'] = $signupHash;
        }
        $ret158541893912ed = $this->sendPost('/sso', [], $array);
        if (! is_array($ret158541893912ed)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret158541893912ed) . ' given');
        }

        return $ret158541893912ed;
    }
    /**
     * Lists all SSO.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret15854189391d5a = $this->sendGet('/sso', $filters);
        if (! is_array($ret15854189391d5a)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189391d5a) . ' given');
        }

        return $ret15854189391d5a;
    }
    /**
     * Retrieves a providerName SSO availability status.
     *
     * @param string $providerName
     *
     * @return array Response
     */
    public function getOne($providerName)
    {
        if (! is_string($providerName)) {
            throw new \InvalidArgumentException('Argument $providerName passed to getOne() must be of the type string, ' . (gettype($providerName) == 'object' ? get_class($providerName) : gettype($providerName)) . ' given');
        }
        $ret15854189391f6e = $this->sendGet(sprintf('/sso/%s', $providerName));
        if (! is_array($ret15854189391f6e)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189391f6e) . ' given');
        }

        return $ret15854189391f6e;
    }
}
