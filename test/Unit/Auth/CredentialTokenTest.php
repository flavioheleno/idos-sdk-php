<?php

namespace idOS\Auth;

use Test\Unit\AbstractUnit;
use idOS\Auth\CredentialToken;


class CredentialTokenTest extends AbstractUnit {
	/**
     * $auth object instantiates the CredentialToken Class.
     */
    protected $auth;

    protected function setUp() {
        parent::setUp();

        $this->auth = new \idOS\Auth\CredentialToken(
            $this->credentials['credentialPublicKey'],
            $this->credentials['handlerPublicKey'],
            $this->credentials['handlerPrivKey']
        );
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

    /**
     * Returns the value of a private property
     * @param [type] $object   the instance of the object
     * @param string $property the name of the property
     * @return $property
     */
    private function getPropertyValue($object, string $property) {
    	$reflection = new \ReflectionClass($object);
		$property = $reflection->getProperty($property);
		$property->setAccessible(true);
		return $property->getValue($object);
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
       	$this->assertNotNull($this->getPropertyValue($this->auth, 'token'));
    }

    public function testGetTokenNull() {
    	$this->setPropertyValue($this->auth, 'token', null);
    	$this->assertNull($this->getPropertyValue($this->auth, 'token'));
    	$this->assertInternalType('string', $this->auth->getToken());
    	$this->assertNotNull($this->getPropertyValue($this->auth, 'token'));
    }
}
