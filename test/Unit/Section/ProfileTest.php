<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace Test\Unit\Section;

use Test\Unit\AbstractUnit;

class ProfileTest extends AbstractUnit
{
    /**
     * $auth object instantiates the CredentialToken Class.
     */
    protected $auth;
    protected $profileSection;
    protected function setUp()
    {
        parent::setUp();
        $this->auth           = new \idOS\Auth\CredentialToken($this->credentials['credentialPublicKey'], $this->credentials['handlerPublicKey'], $this->credentials['handlerPrivKey']);
        $this->profileSection = new \idOS\Section\Profile('userName', $this->auth, new \GuzzleHttp\Client(), false);
    }
    public function testGetMethod()
    {
        $attributeEndpoint = $this->invokeMethod($this->profileSection, '__get', ['Attributes']);
        $this->assertInstanceOf(\idOS\Endpoint\Profile\Attributes::class, $attributeEndpoint);
    }
    public function testCallMethod()
    {
        $processSection = $this->invokeMethod($this->profileSection, '__call', ['Process', [123456]]);
        $this->assertInstanceOf(\idOS\Section\Profile\Process::class, $processSection);
    }
}
