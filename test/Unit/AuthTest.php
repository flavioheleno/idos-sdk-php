<?php

namespace idOS;

use Test\Unit\AbstractUnit;
use idOS\Auth;


class AuthTest extends AbstractUnit {

	/**
     * $auth object instantiates the SDK Class.
     */
    protected $auth;

    protected function setUp() {
        parent::setUp();

        $this->auth = new \idOS\Auth(
            'publicKey',
            'privateKey',
            \idOS\Auth::CREDENTIAL
        );
    }

    /**
     * Invokes private and protected methods.
     * @param  [type] &$object    the instance of the object
     * @param  [type] $method     the name of the method to be invoked
     * @param  array  $parameters the method parameters
     */
    private function invokeMethod(&$object, $method, array $parameters = []) {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }


    /**
     * Sets a value for a private property
     * @param [type] $object   the instance of the object
     * @param string $property the name of the property
     * @param [type] $value    the vaue of the property
     */
    private function setPropertyValue($object, string $property, $value) {
        $reflection = new \ReflectionClass($object);
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }

    public function testSetAndGetPublicKey() {
    	$this->auth->setPublicKey('pubKey');
    	$this->assertSame('pubKey', $this->auth->getPublicKey());
    }

    public function testSetAndGetPrivateKey() {
    	$this->auth->setPrivateKey('privKey');
        $this->assertSame('privKey', $this->auth->getPrivateKey());
    }

    public function testSetAndGetAuthType() {
    	$this->auth->setAuthType(\idOS\Auth::IDENTITY);
        $this->assertEquals(3, $this->auth->getAuthType());
        $this->auth->setAuthType(\idOS\Auth::HANDLER);
        $this->assertEquals(2, $this->auth->getAuthType());
        $this->auth->setAuthType(\idOS\Auth::CREDENTIAL);
        $this->assertEquals(1, $this->auth->getAuthType());
    }

    public function testGetUserToken() {
        $userToken = [
            'user' => 'token'
        ];

        $this->setPropertyValue($this->auth, 'userToken', $userToken);
        $this->assertSame('token', $this->auth->getUserToken('user'));
    }

    public function testGetCredentialToken() {
        $this->setPropertyValue($this->auth, 'credentialToken', 'token');
        $this->assertSame('token', $this->auth->getCredentialToken());
    }

    public function testGetIdentityToken() {
        $this->setPropertyValue($this->auth, 'identityToken', 'token');
        $this->assertSame('token', $this->auth->getIdentityToken());
    }

    public function testGetHeader() {
        $this->auth->setAuthType(\idOS\Auth::CREDENTIAL);
        $this->setPropertyValue($this->auth, 'credentialToken', 'token-xyz');
        $this->assertSame('CredentialToken token-xyz', $this->auth->getHeader());

        $this->auth->setAuthType(\idOS\Auth::IDENTITY);
        $this->setPropertyValue($this->auth, 'identityToken', 'token-xyz');
        $this->assertSame('IdentityToken token-xyz', $this->auth->getHeader());

        $this->auth->setAuthType(\idOS\Auth::HANDLER);
        $this->setPropertyValue($this->auth, 'handlerToken', 'token-xyz');
        $this->assertSame('HandlerToken token-xyz', $this->auth->getHeader());
    }

    public function testGetQuery() {
        $this->auth->setAuthType(\idOS\Auth::CREDENTIAL);
        $this->setPropertyValue($this->auth, 'credentialToken', 'token-xyz');
        $this->assertSame('credentialToken=token-xyz', $this->auth->getQuery());

        $this->auth->setAuthType(\idOS\Auth::IDENTITY);
        $this->setPropertyValue($this->auth, 'identityToken', 'token-xyz');
        $this->assertSame('identityToken=token-xyz', $this->auth->getQuery());

        $this->auth->setAuthType(\idOS\Auth::HANDLER);
        $this->setPropertyValue($this->auth, 'handlerToken', 'token-xyz');
        $this->assertSame('handlerToken=token-xyz', $this->auth->getQuery());
    }
}
