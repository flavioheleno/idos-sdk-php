<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS;

class Auth
{
    /**
     * @const CREDENTIAL
     */
    const CREDENTIAL = 0x1;
    /**
     * @const CREDENTIAL
     */
    const HANDLER = 0x2;
    /**
     * @const IDENTITY
     */
    const IDENTITY = 0x3;
    /**
     * Public Key (handler, credential).
     */
    private $publicKey;
    /**
     * Private Key (handler, credential).
     */
    private $privateKey;
    /**
     * The authorization type (Identity, Credential, User).
     */
    private $authType;
    /**
     * The user token.
     */
    private $userToken = [];
    /**
     * The credential token.
     */
    private $credentialToken;
    /**
     * The identity token.
     */
    private $identityToken;
    /**
     * The handler token.
     */
    private $handlerToken;
    /**
     * Constructor Class.
     *
     * @param string $publicKey
     * @param string $privateKey
     * @param int    $authType
     */
    public function __construct($publicKey, $privateKey, $authType)
    {
        if (! is_string($publicKey)) {
            throw new \InvalidArgumentException('Argument $publicKey passed to __construct() must be of the type string, ' . (gettype($publicKey) == 'object' ? get_class($publicKey) : gettype($publicKey)) . ' given');
        }
        if (! is_string($privateKey)) {
            throw new \InvalidArgumentException('Argument $privateKey passed to __construct() must be of the type string, ' . (gettype($privateKey) == 'object' ? get_class($privateKey) : gettype($privateKey)) . ' given');
        }
        if (! is_int($authType)) {
            throw new \InvalidArgumentException('Argument $authType passed to __construct() must be of the type int, ' . (gettype($authType) == 'object' ? get_class($authType) : gettype($authType)) . ' given');
        }
        $this->publicKey  = $publicKey;
        $this->privateKey = $privateKey;
        $this->authType   = $authType;
    }
    /**
     * Setter to store the public key.
     *
     * @param string $publicKey
     */
    public function setPublicKey($publicKey)
    {
        if (! is_string($publicKey)) {
            throw new \InvalidArgumentException('Argument $publicKey passed to setPublicKey() must be of the type string, ' . (gettype($publicKey) == 'object' ? get_class($publicKey) : gettype($publicKey)) . ' given');
        }
        $this->publicKey   = $publicKey;
        $ret1585418939876e = $this;
        if (! $ret1585418939876e instanceof self) {
            throw new \InvalidArgumentException('Argument returned must be of the type self, ' . (gettype($ret1585418939876e) == 'object' ? get_class($ret1585418939876e) : gettype($ret1585418939876e)) . ' given');
        }

        return $ret1585418939876e;
    }
    /**
     * Getter to return the public key.
     *
     * @return string publicKey
     */
    public function getPublicKey()
    {
        $ret15854189398ada = $this->publicKey;
        if (! is_string($ret15854189398ada)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret15854189398ada) . ' given');
        }

        return $ret15854189398ada;
    }
    /**
     * Setter to store the private key.
     *
     * @param string $privateKey
     */
    public function setPrivateKey($privateKey)
    {
        if (! is_string($privateKey)) {
            throw new \InvalidArgumentException('Argument $privateKey passed to setPrivateKey() must be of the type string, ' . (gettype($privateKey) == 'object' ? get_class($privateKey) : gettype($privateKey)) . ' given');
        }
        $this->privateKey  = $privateKey;
        $ret15854189398c79 = $this;
        if (! $ret15854189398c79 instanceof self) {
            throw new \InvalidArgumentException('Argument returned must be of the type self, ' . (gettype($ret15854189398c79) == 'object' ? get_class($ret15854189398c79) : gettype($ret15854189398c79)) . ' given');
        }

        return $ret15854189398c79;
    }
    /**
     * Getter to return the private key.
     *
     * @return string privateKey
     */
    public function getPrivateKey()
    {
        $ret15854189398fa9 = $this->privateKey;
        if (! is_string($ret15854189398fa9)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret15854189398fa9) . ' given');
        }

        return $ret15854189398fa9;
    }
    /**
     * Sets the authorization type.
     *
     * @param int $authType
     */
    public function setAuthType($authType)
    {
        if (! is_int($authType)) {
            throw new \InvalidArgumentException('Argument $authType passed to setAuthType() must be of the type int, ' . (gettype($authType) == 'object' ? get_class($authType) : gettype($authType)) . ' given');
        }
        $this->authType    = $authType;
        $ret158541893992c4 = $this;
        if (! $ret158541893992c4 instanceof self) {
            throw new \InvalidArgumentException('Argument returned must be of the type self, ' . (gettype($ret158541893992c4) == 'object' ? get_class($ret158541893992c4) : gettype($ret158541893992c4)) . ' given');
        }

        return $ret158541893992c4;
    }
    /**
     * Returnts the authorization type.
     *
     * @return int authType
     */
    public function getAuthType()
    {
        $ret15854189399a21 = $this->authType;
        if (! is_int($ret15854189399a21)) {
            throw new \InvalidArgumentException('Argument returned must be of the type int, ' . gettype($ret15854189399a21) . ' given');
        }

        return $ret15854189399a21;
    }
    /**
     * Returns the user token.
     *
     * @param string $userName
     *
     * @return string userToken
     */
    public function getUserToken($userName)
    {
        if (! is_string($userName)) {
            throw new \InvalidArgumentException('Argument $userName passed to getUserToken() must be of the type string, ' . (gettype($userName) == 'object' ? get_class($userName) : gettype($userName)) . ' given');
        }
        if (isset($this->userToken[$userName])) {
            $ret15854189399cf8 = $this->userToken[$userName];
            if (! is_string($ret15854189399cf8)) {
                throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret15854189399cf8) . ' given');
            }

            return $ret15854189399cf8;
        }
    }
    /**
     * Returns the credential token.
     *
     * @return string credentialToken
     */
    public function getCredentialToken()
    {
        $ret1585418939a0db = $this->credentialToken;
        if (! is_string($ret1585418939a0db)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939a0db) . ' given');
        }

        return $ret1585418939a0db;
    }
    /**
     * Sets the identity token.
     *
     * @param string $token
     */
    public function setIdentityToken($token)
    {
        if (! is_string($token)) {
            throw new \InvalidArgumentException('Argument $token passed to setIdentityToken() must be of the type string, ' . (gettype($token) == 'object' ? get_class($token) : gettype($token)) . ' given');
        }
        $this->identityToken = $token;
        $ret1585418939a394   = $this;
        if (! $ret1585418939a394 instanceof self) {
            throw new \InvalidArgumentException('Argument returned must be of the type self, ' . (gettype($ret1585418939a394) == 'object' ? get_class($ret1585418939a394) : gettype($ret1585418939a394)) . ' given');
        }

        return $ret1585418939a394;
    }
    /**
     * Returns the handler token.
     *
     * @return string handlerToken
     */
    public function getHandlerToken()
    {
        $ret1585418939a726 = $this->handlerToken;
        if (! is_string($ret1585418939a726)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939a726) . ' given');
        }

        return $ret1585418939a726;
    }
    /**
     * Returns the identity token.
     *
     * @return string identityToken
     */
    public function getIdentityToken()
    {
        $ret1585418939a8de = $this->identityToken;
        if (! is_string($ret1585418939a8de)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939a8de) . ' given');
        }

        return $ret1585418939a8de;
    }
    /**
     * Gets the Authorization header related to the authType.
     *
     * @return string header
     */
    public function getHeader()
    {
        switch ($this->authType) {
            case self::CREDENTIAL:
                $ret1585418939aa91 = sprintf('CredentialToken %s', $this->getCredentialToken());
                if (! is_string($ret1585418939aa91)) {
                    throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939aa91) . ' given');
                }

                return $ret1585418939aa91;
            case self::HANDLER:
                $ret1585418939ac39 = sprintf('HandlerToken %s', $this->getHandlerToken());
                if (! is_string($ret1585418939ac39)) {
                    throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939ac39) . ' given');
                }

                return $ret1585418939ac39;
            case self::IDENTITY:
                $ret1585418939ade7 = sprintf('IdentityToken %s', $this->getIdentityToken());
                if (! is_string($ret1585418939ade7)) {
                    throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939ade7) . ' given');
                }

                return $ret1585418939ade7;
        }
    }
    /**
     * Gets the Authorization related to the authType and transforms it to a query parameter.
     *
     * @return string query
     */
    public function getQuery()
    {
        switch ($this->authType) {
            case self::CREDENTIAL:
                $ret1585418939af9d = sprintf('credentialToken=%s', $this->getCredentialToken());
                if (! is_string($ret1585418939af9d)) {
                    throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939af9d) . ' given');
                }

                return $ret1585418939af9d;
            case self::HANDLER:
                $ret1585418939b13b = sprintf('handlerToken=%s', $this->getHandlerToken());
                if (! is_string($ret1585418939b13b)) {
                    throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939b13b) . ' given');
                }

                return $ret1585418939b13b;
            case self::IDENTITY:
                $ret1585418939b2db = sprintf('identityToken=%s', $this->getIdentityToken());
                if (! is_string($ret1585418939b2db)) {
                    throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939b2db) . ' given');
                }

                return $ret1585418939b2db;
        }
    }
}
