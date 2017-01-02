<?php

namespace Test\Unit\Endpoint;

use idOS\Endpoint\Profiles;
use Test\Unit\AbstractUnit;

/**
 * ProfilesTest Class tests all methods from the Profiles Class.
 */
class ProfilesTest extends AbstractUnit {
    /**
     * $profiles object instantiates the Profiles Class.
     */
    private $profiles;

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
            $this->credentials['credentialPublicKey'],
            $this->credentials['handlerPublicKey'],
            $this->credentials['handlerPrivKey']
        );

        $this->profiles = new Profiles($this->auth, $this->httpClient, false);
    }

    public function testGetOne() {
        /**
         * Array response from the fake api call to Profile endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'username'   => 'user',
                'attributes' => [],
                'candidates' => [],
                'scores' => [],
                'gates' => [],
                'flags' => [],
                'sources' => [],
                'recommendation' => null,
                'created_at' => time(),
                'updated_at' => time()
            ]
        ];

        /**
         * Mocks the HTTP Response.
         */
        $httpResponse = $this
            ->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->getMock();
        $httpResponse
            ->method('getBody')
            ->will($this->returnValue(json_encode($array)));
        $this->httpClient
            ->method('request')
            ->will($this->returnValue($httpResponse));

        /**
         * Calls the getOne() method.
         */
        $response = $this->profiles->getOne('user');

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('username', $response['data']);
        $this->assertSame($response['data']['username'], 'user');
        $this->assertArrayHasKey('attributes', $response['data']);
        $this->assertSame($response['data']['attributes'], []);
        $this->assertArrayHasKey('flags', $response['data']);
        $this->assertSame($response['data']['flags'], []);
        $this->assertArrayHasKey('candidates', $response['data']);
        $this->assertSame($response['data']['candidates'], []);
        $this->assertArrayHasKey('scores', $response['data']);
        $this->assertSame($response['data']['scores'], []);
        $this->assertArrayHasKey('gates', $response['data']);
        $this->assertSame($response['data']['gates'], []);
        $this->assertArrayHasKey('scores', $response['data']);
        $this->assertSame($response['data']['scores'], []);
        $this->assertArrayHasKey('recommendation', $response['data']);
        $this->assertNull($response['data']['recommendation']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
}
