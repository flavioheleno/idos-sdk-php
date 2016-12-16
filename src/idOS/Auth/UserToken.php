<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Auth;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class UserToken extends AbstractAuth
{
    /**
     * The userName.
     */
    private $userName;
    /**
     * The credential public key.
     */
    private $credentialPublicKey;
    /**
     * The credential private key.
     */
    private $credentialPrivateKey;
    /**
     * The generated token.
     */
    private $token;
    /**
     * Constructor Class.
     *
     * @param string $userName
     * @param string $credentialPublicKey
     * @param string $credentialPrivateKey
     */
    public function __construct($userName, $credentialPublicKey, $credentialPrivateKey)
    {
        if (! is_string($userName)) {
            throw new \InvalidArgumentException('Argument $userName passed to __construct() must be of the type string, ' . (gettype($userName) == 'object' ? get_class($userName) : gettype($userName)) . ' given');
        }
        if (! is_string($credentialPublicKey)) {
            throw new \InvalidArgumentException('Argument $credentialPublicKey passed to __construct() must be of the type string, ' . (gettype($credentialPublicKey) == 'object' ? get_class($credentialPublicKey) : gettype($credentialPublicKey)) . ' given');
        }
        if (! is_string($credentialPrivateKey)) {
            throw new \InvalidArgumentException('Argument $credentialPrivateKey passed to __construct() must be of the type string, ' . (gettype($credentialPrivateKey) == 'object' ? get_class($credentialPrivateKey) : gettype($credentialPrivateKey)) . ' given');
        }
        $this->userName             = $userName;
        $this->credentialPublicKey  = $credentialPublicKey;
        $this->credentialPrivateKey = $credentialPrivateKey;
    }
    /**
     * Generates the User Token and returns it.
     *
     * @return string userToken
     */
    public function getToken()
    {
        if ($this->token === null || $this->token->isExpired()) {
            $jwtBuilder = new Builder();
            $jwtBuilder->set('iss', $this->credentialPublicKey);
            $jwtBuilder->set('sub', $this->userName);
            $this->token = $jwtBuilder->sign(new Sha256(), $this->credentialPrivateKey)->getToken();
        }
        $ret1585418939707e = (string) $this->token;
        if (! is_string($ret1585418939707e)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939707e) . ' given');
        }

        return $ret1585418939707e;
    }
}
