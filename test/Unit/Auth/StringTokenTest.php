<?php

namespace idOS\Auth;

use Test\Unit\AbstractUnit;
use idOS\Auth\StringToken;


class StringTokenTest extends AbstractUnit {
	/**
     * $auth object instantiates the StringToken Class.
     */
    protected $auth;

    protected function setUp() {
        parent::setUp();

        $credentialToken = new \idOS\Auth\CredentialToken(
            $this->credentials['credentialPublicKey'],
            $this->credentials['handlerPublicKey'],
            $this->credentials['handlerPrivKey']
        );

        $this->auth = new \idOS\Auth\StringToken(
            'CredentialToken',
            $credentialToken->getToken()
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

    public function testGetTokenBasicFlow() {
       	$this->assertInternalType('string', $this->auth->getToken());
    }

    public function testToString() {
        $toString = $this->invokeMethod($this->auth, '__toString');
        $authHeader = explode(' ', $toString);
        $this->assertSame('CredentialToken', $authHeader[0]);
        $this->assertInternalType('string', $authHeader[1]);
    }
}
