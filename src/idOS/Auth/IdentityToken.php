<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Auth;

class IdentityToken extends AbstractAuth
{
    private $token;
    /**
     * Constructor Class.
     *
     * @param string $token the identityToken
     */
    public function __construct($token)
    {
        if (! is_string($token)) {
            throw new \InvalidArgumentException('Argument $token passed to __construct() must be of the type string, ' . (gettype($token) == 'object' ? get_class($token) : gettype($token)) . ' given');
        }
        $this->token = $token;
    }
    /**
     * Returns the token saved on instantiating the IdentityToken Class.
     *
     * @return string identityToken
     */
    public function getToken()
    {
        $ret15854189394c41 = $this->token;
        if (! is_string($ret15854189394c41)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret15854189394c41) . ' given');
        }

        return $ret15854189394c41;
    }
}
