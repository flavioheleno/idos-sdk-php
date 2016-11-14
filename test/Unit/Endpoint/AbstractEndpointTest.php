<?php

namespace Test\Unit\Endpoint;

use Test\Unit\AbstractUnit;
use idOS\Endpoint\AbstractEndpoint;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use idOs\Exception\SDKException;
/**
 * AbstractEndpointTest Class tests the AbstractEndpoint Class.
 */
class AbstractEndpointTest extends AbstractUnit {
	private $abstractMock;
    private $httpClient;
    protected $auth;

	protected function setUp() {
        parent::setUp();

        $this->auth = new \idOS\Auth\CredentialToken(
  			$this->credentials['credentialPublicKey'],
    		$this->credentials['handlerPublicKey'],
    		$this->credentials['handlerPrivKey']
		);

        $this->httpClient = $this
            ->getMockBuilder(Client::class)
            ->getMock();

        $this->abstractMock = $this
        	->getMockBuilder(AbstractEndpoint::class)
        	->setConstructorArgs([$this->auth, $this->httpClient, false])
        	->getMockForAbstractClass();
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

    public function testSendRequestBasicFlow() {
        $array = [
            'status' => true,
            'data' => [
                'key' => 'value'
            ]
        ];

        /**
         * Mocks the HTTP Response
         */
        $httpResponse = $this
            ->getMockBuilder(Response::class)
            ->getMock();
        $httpResponse
            ->method('getBody')
            ->will($this->returnValue(json_encode($array)));
        $this->httpClient
            ->method('request')
            ->will($this->returnValue($httpResponse));

        /**
         * Calls the invokeMethod() that will invoke the private sendRequest() method
         */
    	$response = $this->invokeMethod($this->abstractMock, 'sendRequest', ['get', 'uri']);
        /**
         * Assertions
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('key', $response['data']);
        $this->assertSame('value', $response['data']['key']);
    }

    /**
     * @expectedException idOS\Exception\SDKError
     */
    public function testSendRequestThrowsSDKError() {
        $this->abstractMock = $this
            ->getMockBuilder(AbstractEndpoint::class)
            ->setConstructorArgs([$this->auth, $this->httpClient, true])
            ->getMockForAbstractClass();

        /**
         * Mocks the HTTP Response
         */
        $httpResponse = $this
            ->getMockBuilder(Response::class)
            ->getMock();
        $httpResponse
            ->method('getBody')
            ->will($this->returnValue(json_encode(null)));
        $this->httpClient
            ->method('request')
            ->will($this->returnValue($httpResponse));

        /**
         * Calls the invokeMethod() that will invoke the private sendRequest() method
         */
        $response = $this->invokeMethod($this->abstractMock, 'sendRequest', ['get', 'uri']);
    }

    /**
     * @expectedException idOS\Exception\SDKException
     */
    public function testSendRequestThrowsSDKException() {
        $this->abstractMock = $this
            ->getMockBuilder(AbstractEndpoint::class)
            ->setConstructorArgs([$this->auth, $this->httpClient, true])
            ->getMockForAbstractClass();

        $array = [
            'status' => false,
            'error' => [
                'message' => 'Invalid Credentials',
                'type' => 'Error',
                'link' => 'link'
            ]
        ];

        /**
         * Mocks the HTTP Response
         */
        $httpResponse = $this
            ->getMockBuilder(Response::class)
            ->getMock();
        $httpResponse
            ->method('getBody')
            ->will($this->returnValue(json_encode($array)));
        $this->httpClient
            ->method('request')
            ->will($this->returnValue($httpResponse));

        /**
         * Calls the invokeMethod() that will invoke the private sendRequest() method
         */
        $response = $this->invokeMethod($this->abstractMock, 'sendRequest', ['get', 'uri']);
    }
}
