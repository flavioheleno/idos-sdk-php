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
         * UserToken instance to instantiate the idOS\SDK Class.
         */
        $this->auth = new \idOS\Auth\UserToken(
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
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('name', $array['data'][0]);
        $this->assertSame('test1', $array['data'][0]['name']);
        $this->assertArrayHasKey('creator', $array['data'][0]);
        $this->assertNotEmpty($array['data'][0]['creator']);
        $this->assertContainsOnly('string', $array['data'][0]['creator']);
        $this->assertSame('creator.test', $array['data'][0]['creator'][0]);
        $this->assertArrayHasKey('type', $array['data'][0]);
        $this->assertSame('type', $array['data'][0]['type']);
        $this->assertArrayHasKey('value', $array['data'][0]);
        $this->assertSame('value', $array['data'][0]['value']);
        $this->assertArrayHasKey('source', $array['data'][0]);
        $this->assertSame('test', $array['data'][0]['source']);
        $this->assertTrue(is_int($response['data'][0]['created_at']));
        $this->assertTrue(is_int($response['data'][0]['updated_at']));
    }
}
