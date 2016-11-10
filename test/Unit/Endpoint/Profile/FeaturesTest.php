<?php

namespace Test\Unit\idOS\Endpoint\Profile;

use Test\Unit\idOS\AbstractUnitTest;
use idOS\Endpoint\Profile\Features;

class FeaturesTest extends AbstractUnitTest {

	private $features;

    protected function setUp() {
        parent::setUp();

        /**
         * GuzzleHttp\Client mock.
         */
        $this->httpClient = $this
            ->getMockBuilder('GuzzleHttp\Client')
            ->getMock();

        /**
         * CredentialToken instance to instantiate the idOS\SDK Class.
         */
        $this->auth = new \idOS\Auth\CredentialToken(
            $this->credentials['userName'],
            $this->credentials['credentialPublicKey'],
            $this->credentials['credentialPrivKey']
        );

        $this->features = new Features('dummyUserName', $this->auth, $this->httpClient, false);
    }

    public function testListAll() {
        /**
         * Array response from the fake api call to Features endpoint.
         */
        $array = [
            'status' => true,
            'data' => [
                0 => [
                    'name' => 'test1',
                    'creator' => [
                    	'creator.test'
                    ],
                    'type' => 'type',
                    'value' => 'value',
                    'source' => 'test',
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
        $response = $this->features->listAll();

        /**
         * Assertions
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('name', $response['data'][0]);
        $this->assertSame('test1', $response['data'][0]['name']);
        $this->assertArrayHasKey('creator', $response['data'][0]);
        $this->assertNotEmpty($response['data'][0]['creator']);
        $this->assertContainsOnly('string', $response['data'][0]['creator']);
        $this->assertSame('creator.test', $response['data'][0]['creator'][0]);
        $this->assertArrayHasKey('type', $response['data'][0]);
        $this->assertSame('type', $response['data'][0]['type']);
        $this->assertArrayHasKey('value', $response['data'][0]);
        $this->assertSame('value', $response['data'][0]['value']);
        $this->assertArrayHasKey('source', $response['data'][0]);
        $this->assertSame('test', $response['data'][0]['source']);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
    }
}
