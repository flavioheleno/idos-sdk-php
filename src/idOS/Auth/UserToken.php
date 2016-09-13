<?php

namespace idOS\Auth;

use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Builder;

class UserToken extends AbstractAuth {
    private $userName;
    private $credentialPublicKey;
    private $credentialPrivateKey;
    private $token;

    public function __construct(
        string $userName,
        string $credentialPublicKey,
        string $credentialPrivateKey
    ) {
        $this->userName             = $userName;
        $this->credentialPublicKey  = $credentialPublicKey;
        $this->credentialPrivateKey = $credentialPrivateKey;
    }

    public function getToken() : string {
        if (($this->token === null) || ($this->token->isExpired())) {
            $jwtBuilder = new Builder();
            $jwtBuilder->set('iss', $this->credentialPublicKey);
            $jwtBuilder->set('sub', $this->userName);

            $this->token = $jwtBuilder
                ->sign(new Sha256(), $this->credentialPrivateKey)
                ->getToken();
        }

        return (string) $this->token;
    }
}
