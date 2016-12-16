<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace Test\Unit\Auth;

use idOS\Auth\CredentialToken;
use Test\Unit\AbstractUnit;

class AbstractAuthTest extends AbstractUnit
{
    protected $abstractAuth;
    protected function setUp()
    {
        parent::setUp();
        $this->abstractAuth = new \idOS\Auth\CredentialToken($this->credentials['credentialPublicKey'], $this->credentials['handlerPublicKey'], $this->credentials['handlerPrivKey']);
    }
    public function testToString()
    {
        $this->abstractAuth->getToken();
        $toString   = $this->invokeMethod($this->abstractAuth, '__toString');
        $authHeader = explode(' ', $toString);
        $this->assertSame('CredentialToken', $authHeader[0]);
        $this->assertInternalType('string', $authHeader[1]);
    }
}
