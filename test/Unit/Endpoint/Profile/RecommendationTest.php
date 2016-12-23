<?php

namespace Test\Unit\Endpoint\Profile;

use idOS\Endpoint\Profile\Recommendation;
use Test\Unit\AbstractUnit;

/**
 * RecommendationTest Class tests all methods from the recommendation Class.
 */
class RecommendationTest extends AbstractUnit {
    /**
     * Profile recommendation endpoint instance.
     */
    protected $recommendation;

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

        $this->recommendation = new Recommendation('dummyUserName', $this->auth, $this->httpClient, false);
    }

    public function testGetOne() {
        /**
         * Array response from the fake api call to recommendation endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'result'     => 'pass',
                'passed'     => [],
                'failed'     => [],
                'created_at' => time(),
                'updated_at' => time()
            ]
        ];

        /**
         * Mocks the HTTP Response.
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
         * Calls the getOne() method.
         */
        $response = $this->recommendation->getOne();

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('result', $response['data']);
        $this->assertSame('pass', $response['data']['result']);
        $this->assertArrayHasKey('passed', $response['data']);
        $this->assertSame([], $response['data']['passed']);
        $this->assertArrayHasKey('failed', $response['data']);
        $this->assertSame([], $response['data']['failed']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
    
    public function testUpsertOne() {
        /**
         * Array response from the fake api call to recommendation endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'result'     => 'pass',
                'passed'     => [],
                'failed'     => [],
                'created_at' => time(),
                'updated_at' => time()
            ]
        ];

        /**
         * Mocks the HTTP Response.
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
         * Calls the upsertOne() method.
         */
        $response = $this->recommendation->upsertOne('pass', [], []);

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('result', $response['data']);
        $this->assertSame('pass', $response['data']['result']);
        $this->assertArrayHasKey('passed', $response['data']);
        $this->assertSame([], $response['data']['passed']);
        $this->assertArrayHasKey('failed', $response['data']);
        $this->assertSame([], $response['data']['failed']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }    
}
