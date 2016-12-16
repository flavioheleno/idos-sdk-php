<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Auth;

use Test\Unit\AbstractUnit;

class StringTokenTest extends AbstractUnit
{
    /**
     * $auth object instantiates the StringToken Class.
     */
    protected $auth;
    protected function setUp()
    {
        parent::setUp();
        $credentialToken = new \idOS\Auth\CredentialToken($this->credentials['credentialPublicKey'], $this->credentials['handlerPublicKey'], $this->credentials['handlerPrivKey']);
        $this->auth      = new \idOS\Auth\StringToken('CredentialToken', $credentialToken->getToken());
    }
    public function testGetTokenBasicFlow()
    {
        $this->assertInternalType('string', $this->auth->getToken());
    }
    public function testToString()
    {
        $toString   = $this->invokeMethod($this->auth, '__toString');
        $authHeader = explode(' ', $toString);
        $this->assertSame('CredentialToken', $authHeader[0]);
        $this->assertInternalType('string', $authHeader[1]);
    }
}
