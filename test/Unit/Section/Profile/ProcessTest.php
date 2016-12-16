<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace Test\Unit\Section\Profile;

use Test\Unit\AbstractUnit;

class ProcessTest extends AbstractUnit
{
    /**
     * $auth object instantiates the CredentialToken Class.
     */
    protected $auth;
    protected $processSection;
    protected function setUp()
    {
        parent::setUp();
        $this->auth           = new \idOS\Auth\CredentialToken($this->credentials['credentialPublicKey'], $this->credentials['handlerPublicKey'], $this->credentials['handlerPrivKey']);
        $this->processSection = new \idOS\Section\Profile\Process(123456, 'userName', $this->auth, new \GuzzleHttp\Client(), false);
    }
    public function testGetMethod()
    {
        $attributeEndpoint = $this->invokeMethod($this->processSection, '__get', ['Tasks']);
        $this->assertInstanceOf(\idOS\Endpoint\Profile\Process\Tasks::class, $attributeEndpoint);
    }
}
