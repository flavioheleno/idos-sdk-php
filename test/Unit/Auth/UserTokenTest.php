<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace idOS\Auth;

use Test\Unit\AbstractUnit;
class UserTokenTest extends AbstractUnit
{
    /**
     * $auth object instantiates the UserToken Class.
     */
    protected $auth;
    protected function setUp()
    {
        parent::setUp();
        $this->auth = new \idOS\Auth\UserToken($this->credentials['userName'], $this->credentials['credentialPublicKey'], $this->credentials['credentialPrivKey']);
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