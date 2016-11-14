<?php

namespace Test\Unit\Section;

use Test\Unit\AbstractUnit;

class ProfileTest extends AbstractUnit {
	/**
     * $auth object instantiates the CredentialToken Class.
     */
    protected $auth;
    protected $profileSection;

    protected function setUp() {
        parent::setUp();

        $this->auth = new \idOS\Auth\CredentialToken(
            $this->credentials['credentialPublicKey'],
            $this->credentials['handlerPublicKey'],
            $this->credentials['handlerPrivKey']
        );

       	$this->profileSection = new \idOS\Section\Profile(
       		'userName',
       		$this->auth,
       		new \GuzzleHttp\Client(),
       		false
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

    public function testGetMethod() {
    	$attributeEndpoint = $this->invokeMethod($this->profileSection, '__get', ['Attributes']);
		$this->assertInstanceOf(\idOS\Endpoint\Profile\Attributes::class, $attributeEndpoint);
    }

    public function testCallMethod() {
    	$processSection = $this->invokeMethod($this->profileSection, '__call', ['Process', [123456]]);
		$this->assertInstanceOf(\idOS\Section\Profile\Process::class, $processSection);
	}
}
