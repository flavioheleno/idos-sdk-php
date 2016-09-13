<?php

namespace idOS\Auth;

use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Builder;

class CredentialToken extends AbstractAuth {
    private $credentialPublicKey;
    private $handlerPublicKey;
    private $handlerPrivateKey;
    private $token;

    public function __construct(
        string $credentialPublicKey,
        string $handlerPublicKey,
        string $handlerPrivateKey
    ) {
        $this->credentialPublicKey = $credentialPublicKey;
        $this->handlerPublicKey    = $handlerPublicKey;
        $this->handlerPrivateKey   = $handlerPrivateKey;
    }

    public function getToken() : string {
        if (($this->token === null) || ($this->token->isExpired())) {
            $jwtBuilder = new Builder();
            $jwtBuilder->set('iss', $this->handlerPublicKey);
            $jwtBuilder->set('sub', $this->credentialPublicKey);

            $this->token = $jwtBuilder
                ->sign(new Sha256(), $this->handlerPrivateKey)
                ->getToken();
        }

        return (string) $this->token;
    }
}
