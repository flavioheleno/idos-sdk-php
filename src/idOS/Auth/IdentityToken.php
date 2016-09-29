<?php

namespace idOS\Auth;

class IdentityToken extends AbstractAuth {
    private $token;

    /**
     * Constructor Class.
     *
     * @param string $token the identityToken
     */
    public function __construct(string $token) {
        $this->token = $token;
    }

    /**
     * Returns the token saved on instantiating the IdentityToken Class.
     *
     * @return string identityToken
     */
    public function getToken() : string {
        return $this->token;
    }
}
