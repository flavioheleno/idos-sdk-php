<?php

namespace idOS\Auth;

use Test\Unit\AbstractUnit;

class IdentityTokenTest extends AbstractUnit {
    /**
     * $auth object instantiates the IdentityToken Class.
     */
    protected $auth;
    protected $token;

    protected function setUp() {
        parent::setUp();

        $this->token = 'apiResponseIdentityToken';

        $this->auth = new \idOS\Auth\IdentityToken(
            $this->token
        );
    }

    public function testGetToken() {
           $this->assertInternalType('string', $this->auth->getToken());
           $this->assertSame('apiResponseIdentityToken', $this->getPropertyValue($this->auth, 'token'));
    }
}
