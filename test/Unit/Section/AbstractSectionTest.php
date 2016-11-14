<?php

namespace Test\Unit\Section;

use Test\Unit\AbstractUnit;
use idOS\Section\Profile;

class AbstractSectionTest extends AbstractUnit {
	/**
     * $auth object instantiates the CredentialToken Class.
     */
    protected $auth;
    protected $section;

    protected function setUp() {
        parent::setUp();

        $this->auth = new \idOS\Auth\CredentialToken(
            $this->credentials['credentialPublicKey'],
            $this->credentials['handlerPublicKey'],
            $this->credentials['handlerPrivKey']
        );

        $this->section = new Profile(
   		   'userName',

           $this->auth,
   		   new \GuzzleHttp\Client(),
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

    public function testGetEndpointClassNameExpectedFlow() {
        $this->assertSame(
            'idOS\Endpoint\Profile\Attributes',
            $this->invokeMethod($this->section, 'getEndpointClassName', ['Attributes'])
        );
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Invalid endpoint name "Dummy" (idOS\Endpoint\Profile\Dummy)
     */
    public function testGetEndpointClassNameThrowsException() {
        $this->invokeMethod($this->section, 'getEndpointClassName', ['Dummy']);
    }

    public function testGetSectionClassnameExpectedFlow() {
        $this->assertSame(
            'idOS\Section\Profile\Process',
            $this->invokeMethod($this->section, 'getSectionClassName', ['Process'])
        );
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Invalid section name "Dummy" (idOS\Section\Profile\Dummy)
     */
    public function testGetSectionClassNameThrowsException() {
        $this->invokeMethod($this->section, 'getSectionClassName', ['Dummy']);
    }
}
