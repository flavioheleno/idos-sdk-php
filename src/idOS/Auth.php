<?php

namespace idOS;

class Auth {
    /**
     *
     * @const CREDENTIAL
     */
    const CREDENTIAL = 0x01;

    /**
     *
     * @const CREDENTIAL
     */
    const HANDLER = 0x02;

    /**
     *
     * @const IDENTITY
     */
    const IDENTITY = 0x03;

    /**
     * Public Key (handler, credential)
     */
    private $publicKey;
    /**
     * Private Key (handler, credential)
     */
    private $privateKey;
    /**
     * The authorization type (Identity, Credential, User)
     */
    private $authType;
    /**
     * The user token
     */
    private $userToken = [];
    /**
     * The credential token
     */
    private $credentialToken;
    /**
     * The identity token
     */
    private $identityToken;

    /**
     * Constructor Class
     * @param string $publicKey
     * @param string $privateKey
     * @param int    $authType
     */
    public function __construct(
        string $publicKey,
        string $privateKey,
        int $authType
    ) {
        $this->publicKey  = $publicKey;
        $this->privateKey = $privateKey;
        $this->authType   = $authType;
    }

    /**
     * Setter to store the public key
     * @param string $publicKey
     */
    public function setPublicKey(string $publicKey) : self {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * Getter to return the public key
     * @return string publicKey
     */
    public function getPublicKey() : string {
        return $this->publicKey;
    }

    /**
     * Setter to store the private key
     * @param string $privateKey
     */
    public function setPrivateKey(string $privateKey) : self {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * Getter to return the private key
     * @return string privateKey
     */
    public function getPrivateKey() : string {
        return $this->privateKey;
    }

    /**
     * Sets the authorization type
     * @param int $authType
     */
    public function setAuthType(int $authType) : self {
        $this->authType = $authType;

        return $this;
    }

    /**
     * Returnts the authorization type
     * @return int authType
     */
    public function getAuthType() : int {
        return $this->authType;
    }

    /**
     * Returns the user token
     * @param  string $userName
     * @return string userToken
     */
    public function getUserToken(string $userName) : string {
        if (isset($this->userToken[$userName])) {
            return $this->userToken[$userName];
        }
    }

    /**
     * Returns the credential token
     * @return string credentialToken
     */
    public function getCredentialToken() : string {
        return $this->credentialToken;
    }

    /**
     * Sets the identity token
     * @param string $token
     */
    public function setIdentityToken(string $token) : self {
        $this->identityToken = $token;

        return $this;
    }

    /**
     * Returns the identity token
     * @return string identityToken
     */
    public function getIdentityToken() : string {
        return $this->identityToken;o
    }

    /**
     * Gets the Authorization header related to the authType
     * @return string header
     */
    public function getHeader() : string {
        switch ($this->authType) {
            case self::CREDENTIAL:
                return sprintf('CredentialToken %s', $this->getCredentialToken());
            case self::USER:
                return sprintf('UserToken %s', $this->getUserToken());
            case self::IDENTITY:
                return sprintf('IdentityToken %s', $this->getIdentityToken());
        }
        throw new \RuntimeException(
            sprintf(
                'Invalid auth type "%d"',
                $this->authType
            )
        );
    }

    /**
     * Gets the Authorization related to the authType and transforms it to a query parameter
     * @return string query
     */
    public function getQuery() : string {
        switch ($this->authType) {
            case self::CREDENTIAL:
                return sprintf('credentialToken=%s', $this->getCredentialToken());
            case self::USER:
                return sprintf('userToken=%s', $this->getUserToken());
            case self::IDENTITY:
                return sprintf('identityToken=%s', $this->getIdentityToken());
        }
        throw new \RuntimeException(
            sprintf(
                'Invalid auth type "%d"',
                $this->authType
            )
        );
    }
}
