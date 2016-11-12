<?php

namespace Test\Unit\Endpoint;

use Test\Unit\AbstractUnitTest;
use idOS\Endpoint\AbstractEndpoint;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * AbstractEndpointTest Class tests the AbstractEndpoint Class.
 */
class AbstractEndpointTest extends AbstractUnitTest {
	private $abstractMock;
    private $httpClient;

	protected function setUp() {
        parent::setUp();

        $auth = new \idOS\Auth\CredentialToken(
  			$this->credentials['credentialPublicKey'],
    		$this->credentials['handlerPublicKey'],
    		$this->credentials['handlerPrivKey']
		);

        $this->httpClient = $this
            ->getMockBuilder(Client::class)
            ->getMock();

        $this->abstractMock = $this
        	->getMockBuilder(AbstractEndpoint::class)
        	->setConstructorArgs([$auth, $this->httpClient, false])
        	->getMockForAbstractClass();
    }

    /**
     * Invokes private and protected methods.
     */
    private function invokeMethod(&$object, $methodName, array $parameters = []) {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
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
     * @expectedException=SDKError
     * @return [type] [description]
     */
    public function testSendRequestThrowsSDKError() {
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

    public function testSendRequestReturnsArrayResponseError() {

    }
}
