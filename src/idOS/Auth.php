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

    private $publicKey;
    private $privateKey;
    private $authType;
    private $userToken = [];
    private $credentialToken;
    private $identityToken;

    public function __construct(
        string $publicKey,
        string $privateKey,
        int $authType
    ) {
        $this->publicKey  = $publicKey;
        $this->privateKey = $privateKey;
        $this->authType   = $authType;
    }

    public function setPublicKey(string $publicKey) : self {
        $this->publicKey = $publicKey;

        return $this;
    }

    public function getPublicKey() : string {
        return $this->publicKey;
    }

    public function setPrivateKey(string $privateKey) : self {
        $this->privateKey = $privateKey;

        return $this;
    }

    public function getPrivateKey() : string {
        return $this->privateKey;
    }

    public function setAuthType(int $authType) : self {
        $this->authType = $authType;

        return $this;
    }

    public function getAuthType() : int {
        return $this->authType;
    }

    public function getUserToken(string $userName) : string {
        if (isset($this->userToken[$userName])) {
            return $this->userToken[$userName];
        }

        // generate user token
    }

    public function getCredentialToken() : string {
        return $this->credentialToken;
    }

    public function setIdentityToken(string $token) : self {
        $this->identityToken = $token;

        return $this;
    }

    public function getIdentityToken() : string {
        return $this->identityToken;
    }

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
