<?php

namespace Test\Unit\Auth;

use Test\Unit\AbstractUnit;
use idOS\Auth\CredentialToken;

class AbstractAuthTest extends AbstractUnit {
	protected $abstractAuth;

    protected function setUp() {
        parent::setUp();

        $this->abstractAuth =  new \idOS\Auth\CredentialToken(
            $this->credentials['credentialPublicKey'],
            $this->credentials['handlerPublicKey'],
            $this->credentials['handlerPrivKey']
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

    public function testToString() {
    	$this->abstractAuth->getToken();
    	$toString = $this->invokeMethod($this->abstractAuth, '__toString');
        $authHeader = explode(' ', $toString);
        $this->assertSame('CredentialToken', $authHeader[0]);
        $this->assertInternalType('string', $authHeader[1]);
    }
}
