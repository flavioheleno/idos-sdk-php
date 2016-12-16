<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Auth;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

/**
 * Credential Token Class that generates the Credential token.
 */
class CredentialToken extends AbstractAuth
{
    /**
     * The credential Public Key.
     */
    private $credentialPublicKey;
    /**
     * The handler Public Key.
     */
    private $handlerPublicKey;
    /**
     * The handler Private Key.
     */
    private $handlerPrivateKey;
    /**
     * The generated token.
     */
    private $token;
    /**
     * Constructor Class.
     *
     * @param string $credentialPublicKey
     * @param string $handlerPublicKey
     * @param string $handlerPrivateKey
     */
    public function __construct($credentialPublicKey, $handlerPublicKey, $handlerPrivateKey)
    {
        if (! is_string($credentialPublicKey)) {
            throw new \InvalidArgumentException('Argument $credentialPublicKey passed to __construct() must be of the type string, ' . (gettype($credentialPublicKey) == 'object' ? get_class($credentialPublicKey) : gettype($credentialPublicKey)) . ' given');
        }
        if (! is_string($handlerPublicKey)) {
            throw new \InvalidArgumentException('Argument $handlerPublicKey passed to __construct() must be of the type string, ' . (gettype($handlerPublicKey) == 'object' ? get_class($handlerPublicKey) : gettype($handlerPublicKey)) . ' given');
        }
        if (! is_string($handlerPrivateKey)) {
            throw new \InvalidArgumentException('Argument $handlerPrivateKey passed to __construct() must be of the type string, ' . (gettype($handlerPrivateKey) == 'object' ? get_class($handlerPrivateKey) : gettype($handlerPrivateKey)) . ' given');
        }
        $this->credentialPublicKey = $credentialPublicKey;
        $this->handlerPublicKey    = $handlerPublicKey;
        $this->handlerPrivateKey   = $handlerPrivateKey;
    }
    /**
     * Generates the credential token and returns it.
     *
     * @return string credentialToken
     */
    public function getToken()
    {
        if ($this->token === null || $this->token->isExpired()) {
            $jwtBuilder = new Builder();
            $jwtBuilder->set('iss', $this->handlerPublicKey);
            $jwtBuilder->set('sub', $this->credentialPublicKey);
            $this->token = $jwtBuilder->sign(new Sha256(), $this->handlerPrivateKey)->getToken();
        }
        $ret15854189393308 = (string) $this->token;
        if (! is_string($ret15854189393308)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret15854189393308) . ' given');
        }

        return $ret15854189393308;
    }
}
