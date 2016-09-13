<?php

namespace idOS\Auth;

class IdentityToken extends AbstractAuth {
    private $token;

    public function __construct(string $token) {
        $this->token = $token;
    }

    public function getToken() : string {
        return $this->token;
    }
}
