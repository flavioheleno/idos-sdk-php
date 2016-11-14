<?php

namespace idOS;

use Test\Unit\AbstractUnit;
use idOS\SDK;


class SDKTest extends AbstractUnit {

	/**
     * $auth object instantiates the SDK Class.
     */
    protected $sdk;
    protected $auth;

    protected function setUp() {
        parent::setUp();

        $this->auth = new \idOS\Auth\CredentialToken(
            $this->credentials['credentialPublicKey'],
            $this->credentials['handlerPublicKey'],
            $this->credentials['handlerPrivKey']
        );

        $this->sdk = SDK::create(
        	$this->auth,
            false
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

    public function testSetAndGetAuth() {
    	$this->sdk->setAuth($this->auth);
    	$this->assertSame($this->auth, $this->sdk->getAuth());
    }
    public function testSetAndGetClient() {
    	$client = new \GuzzleHttp\Client();
    	$this->sdk->setClient($client);
    	$this->assertSame($client, $this->sdk->getClient());
    }

    public function testSetAndGetThrowsExceptions() {
    	$this->sdk->setThrowsExceptions(false);
    	$this->assertFalse($this->sdk->getThrowsExceptions());
    	$this->sdk->setThrowsExceptions(true);
    	$this->assertTrue($this->sdk->getThrowsExceptions());
    }

    public function testProfileSection() {
    	$this->assertInstanceOf(
    		\idOS\Section\Profile::class,
    		$this->sdk->profile('userName')
    	);
    }

    public function testCompanySection() {
    	$this->assertInstanceOf(
    		\idOS\Section\Company::class,
    		$this->sdk->company('company-slug')
    	);
    }

    public function testGet() {
    	$this->assertInstanceOf(
    		\idOS\Endpoint\Sso::class,
    		$this->invokeMethod($this->sdk, '__get', ['Sso'])
    	);
    }

    public function testGetEndpointClassName() {
    	$this->assertSame('idOS\Endpoint\Sso', $this->invokeMethod($this->sdk, 'getEndpointClassName', ['sso']));
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Invalid endpoint name "dummy" (idOS\Endpoint\Dummy)
     */
    public function testGetEndpointClassNameThrowsException() {
    	$this->invokeMethod($this->sdk, 'getEndpointClassName', ['dummy']);
    }
}
