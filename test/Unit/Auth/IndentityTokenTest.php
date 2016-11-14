<?php

namespace idOS\Auth;

use Test\Unit\AbstractUnit;
use idOS\Auth\IdentityToken;


class IdentityTokenTest extends AbstractUnit {
	/**
     * $auth object instantiates the IdentityToken Class.
     */
    protected $auth;
    protected $token;

    protected function setUp() {
        parent::setUp();

        $this->token = 'apiResponseIdentityToken';

        $this->auth = new \idOS\Auth\IdentityToken(
            $this->token
        );
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

    public function testGetToken() {
       	$this->assertInternalType('string', $this->auth->getToken());
       	$this->assertSame('apiResponseIdentityToken', $this->getPropertyValue($this->auth, 'token'));
    }
}
