<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace Test\Unit\Section;

use idOS\Section\Profile;
use Test\Unit\AbstractUnit;
class AbstractSectionTest extends AbstractUnit
{
    /**
     * $auth object instantiates the CredentialToken Class.
     */
    protected $auth;
    protected $section;
    protected function setUp()
    {
        parent::setUp();
        $this->auth = new \idOS\Auth\CredentialToken($this->credentials['credentialPublicKey'], $this->credentials['handlerPublicKey'], $this->credentials['handlerPrivKey']);
        $this->section = new Profile('userName', $this->auth, new \GuzzleHttp\Client(), false);
    }
    public function testGetEndpointClassNameExpectedFlow()
    {
        $this->assertSame('idOS\\Endpoint\\Profile\\Attributes', $this->invokeMethod($this->section, 'getEndpointClassName', ['Attributes']));
    }
    public function testGetEndpointClassNameThrowsException()
    {
        $this->setExpectedException(\RuntimeException::class);
        $this->invokeMethod($this->section, 'getEndpointClassName', ['Dummy']);
    }
    public function testGetSectionClassnameExpectedFlow()
    {
        $this->assertSame('idOS\\Section\\Profile\\Process', $this->invokeMethod($this->section, 'getSectionClassName', ['Process']));
    }
    public function testGetSectionClassNameThrowsException()
    {
        $this->setExpectedException(\RuntimeException::class);
        $this->invokeMethod($this->section, 'getSectionClassName', ['Dummy']);
    }
}