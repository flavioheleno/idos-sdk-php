<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Auth;

use Test\Unit\AbstractUnit;

class CredentialTokenTest extends AbstractUnit
{
    /**
     * $auth object instantiates the CredentialToken Class.
     */
    protected $auth;
    protected function setUp()
    {
        parent::setUp();
        $this->auth = new \idOS\Auth\CredentialToken($this->credentials['credentialPublicKey'], $this->credentials['handlerPublicKey'], $this->credentials['handlerPrivKey']);
    }
    public function testGetTokenBasicFlow()
    {
        $this->assertInternalType('string', $this->auth->getToken());
        $this->assertNotNull($this->getPropertyValue($this->auth, 'token'));
    }
    public function testGetTokenNull()
    {
        $this->setPropertyValue($this->auth, 'token', null);
        $this->assertNull($this->getPropertyValue($this->auth, 'token'));
        $this->assertInternalType('string', $this->auth->getToken());
        $this->assertNotNull($this->getPropertyValue($this->auth, 'token'));
    }
}
