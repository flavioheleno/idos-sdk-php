<?php

namespace Test\Unit\Endpoint\Profile;

use Test\Unit\AbstractUnitTest;
use GuzzleHttp\Client;
use idOS\Endpoint\Profile\Attributes;
use idOS\Section\Profile;

/**
 * AttributesTest Class tests all methods from the Attributes Class.
 */
class AttributesTest extends AbstractUnitTest {
    /**
     * $attributes object instantiates the Attributes Class.
     */
    protected $attributes;

    protected function setUp() {
        parent::setUp();

        /**
         * GuzzleHttp\Client mock.
         */
        $this->httpClient = $this
            ->getMockBuilder('GuzzleHttp\Client')
            ->getMock();

        /**
         * UserToken instance to instantiate the idOS\SDK Class.
         */
        $this->auth = new \idOS\Auth\UserToken(
            $this->credentials['userName'],
            $this->credentials['credentialPublicKey'],
            $this->credentials['credentialPrivKey']
        );

        $this->attributes = new Attributes('dummyUserName', $this->auth, $this->httpClient, false);
    }

    public function testListAll() {
        /**
         * Array response from the fake api call to Attributes endpoint.
         */
        $array = [
            'status' => true,
            'data' => [
                0 => [
                    'userName' => 'user1',
                    'created_at' => time(),
                    'updated_at' => time()
                ],
                1 => [
                    'userName' => 'user2',
                    'created_at' => time(),
                    'updated_at' => time()
                ]
            ]
        ];

        /**
         * Mocks the HTTP Response
         */
        $this->httpResponse = $this
            ->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->getMock();
        $this->httpResponse
            ->method('getBody')
            ->will($this->returnValue(json_encode($array)));
        $this->httpClient
            ->method('request')
            ->will($this->returnValue($this->httpResponse));

        /**
         * Calls the listAll() method.
         */
        $response = $this->attributes->listAll();

        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('userName', $response['data'][0]);
        $this->assertSame('user1', $response['data'][0]['userName']);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
        $this->assertArrayHasKey('userName', $response['data'][1]);
        $this->assertSame('user2', $response['data'][1]['userName']);
        $this->assertInternalType('int', $response['data'][1]['created_at']);
        $this->assertInternalType('int', $response['data'][1]['updated_at']);
    }
}

