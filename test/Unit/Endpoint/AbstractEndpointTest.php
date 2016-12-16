<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace Test\Unit\Endpoint;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use idOS\Endpoint\AbstractEndpoint;
use Test\Unit\AbstractUnit;
/**
 * AbstractEndpointTest Class tests the AbstractEndpoint Class.
 */
class AbstractEndpointTest extends AbstractUnit
{
    private $abstractMock;
    private $httpClient;
    protected $auth;
    protected function setUp()
    {
        parent::setUp();
        $this->auth = new \idOS\Auth\CredentialToken($this->credentials['credentialPublicKey'], $this->credentials['handlerPublicKey'], $this->credentials['handlerPrivKey']);
        $this->httpClient = $this->getMockBuilder(Client::class)->getMock();
        $this->abstractMock = $this->getMockBuilder(AbstractEndpoint::class)->setConstructorArgs([$this->auth, $this->httpClient, false])->getMockForAbstractClass();
    }
    public function testSendRequestBasicFlow()
    {
        $array = ['status' => true, 'data' => ['key' => 'value']];
        /**
         * Mocks the HTTP Response.
         */
        $httpResponse = $this->getMockBuilder(Response::class)->getMock();
        $httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($httpResponse));
        /**
         * Calls the invokeMethod() that will invoke the private sendRequest() method.
         */
        $response = $this->invokeMethod($this->abstractMock, 'sendRequest', ['get', 'uri']);
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('key', $response['data']);
        $this->assertSame('value', $response['data']['key']);
    }
    public function testSendRequestThrowsSDKError()
    {
        $this->abstractMock = $this->getMockBuilder(AbstractEndpoint::class)->setConstructorArgs([$this->auth, $this->httpClient, true])->getMockForAbstractClass();
        /**
         * Mocks the HTTP Response.
         */
        $httpResponse = $this->getMockBuilder(Response::class)->getMock();
        $httpResponse->method('getBody')->will($this->returnValue(json_encode(null)));
        $this->httpClient->method('request')->will($this->returnValue($httpResponse));
        $this->setExpectedException(\idOS\Exception\SDKError::class);
        /**
         * Calls the invokeMethod() that will invoke the private sendRequest() method.
         */
        $response = $this->invokeMethod($this->abstractMock, 'sendRequest', ['get', 'uri']);
    }
    public function testSendRequestWithErrorButThrowsExceptionFalse()
    {
        $this->abstractMock = $this->getMockBuilder(AbstractEndpoint::class)->setConstructorArgs([$this->auth, $this->httpClient, false])->getMockForAbstractClass();
        $array = ['status' => false, 'error' => ['message' => 'Invalid Credentials', 'type' => 'Error', 'link' => 'link']];
        /**
         * Mocks the HTTP Response.
         */
        $httpResponse = $this->getMockBuilder(Response::class)->getMock();
        $httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($httpResponse));
        /**
         * Calls the invokeMethod() that will invoke the private sendRequest() method.
         */
        $response = $this->invokeMethod($this->abstractMock, 'sendRequest', ['get', 'uri']);
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertFalse($response['status']);
        $this->assertArrayHasKey('error', $response);
        $this->assertNotEmpty($response['error']);
        $this->assertArrayHasKey('message', $response['error']);
        $this->assertSame('Invalid Credentials', $response['error']['message']);
        $this->assertArrayHasKey('type', $response['error']);
        $this->assertSame('Error', $response['error']['type']);
        $this->assertArrayHasKey('link', $response['error']);
        $this->assertSame('link', $response['error']['link']);
    }
    public function testSendRequestThrowsSDKException()
    {
        $this->abstractMock = $this->getMockBuilder(AbstractEndpoint::class)->setConstructorArgs([$this->auth, $this->httpClient, true])->getMockForAbstractClass();
        $array = ['status' => false, 'error' => ['message' => 'Invalid Credentials', 'type' => 'Error', 'link' => 'link']];
        /**
         * Mocks the HTTP Response.
         */
        $httpResponse = $this->getMockBuilder(Response::class)->getMock();
        $httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($httpResponse));
        $this->setExpectedException(\idOS\Exception\SDKException::class);
        /**
         * Calls the invokeMethod() that will invoke the private sendRequest() method.
         */
        $response = $this->invokeMethod($this->abstractMock, 'sendRequest', ['get', 'uri']);
    }
}