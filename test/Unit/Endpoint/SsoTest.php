<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace Test\Unit\Endpoint;

use idOS\Endpoint\Sso;
use Test\Unit\AbstractUnit;

/**
 * SsoTest Class tests all methods from the Sso Class.
 */
class SsoTest extends AbstractUnit
{
    /**
     * $sso object instantiates the Sso Class.
     */
    private $sso;
    protected function setUp()
    {
        parent::setUp();
        /**
         * GuzzleHttp\Client mock.
         */
        $this->httpClient = $this->getMockBuilder('GuzzleHttp\\Client')->getMock();
        /**
         * CredentialToken instance to instantiate the idOS\SDK Class.
         */
        $this->auth = new \idOS\Auth\None();
        $this->sso  = new Sso($this->auth, $this->httpClient, false);
    }
    public function testListAll()
    {
        /**
         * Array response from the fake api call to Sso endpoint.
         */
        $array = ['status' => true, 'data' => ['facebook', 'twitter', 'paypal']];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the listAll() method.
         */
        $response = $this->sso->listAll();
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response['data']);
        $this->assertContainsOnly('string', $response['data']);
    }
    public function testGetOne()
    {
        /**
         * Array response from the fake api call to Sso endpoint.
         */
        $array = ['status' => true, 'data' => ['enabled' => true]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the getOne() method.
         */
        $response = $this->sso->getOne('twitter');
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('enabled', $response['data']);
        $this->assertTrue($response['data']['enabled']);
    }
    public function testCreateNew()
    {
        /**
         * Array response from the fake api call to Sso endpoint.
         */
        $array = ['status' => true, 'data' => ['userName' => 'user', 'user_token' => 'dummyToken']];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the createNew() method.
         */
        $response = $this->sso->createNew('twitter', 'DummyCredentialPublicKey', 'DummyUserToken', 'DummySecretToken');
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('userName', $response['data']);
        $this->assertSame($response['data']['userName'], 'user');
        $this->assertArrayHasKey('user_token', $response['data']);
        $this->assertSame($response['data']['user_token'], 'dummyToken');
    }
}
