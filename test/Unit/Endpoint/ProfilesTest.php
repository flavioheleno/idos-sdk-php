<?php

namespace Test\Unit\Endpoint;

use Test\Unit\AbstractUnit;
use GuzzleHttp\Client;
use idOS\Endpoint\Profiles;

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

    public function testListAll() {
        /**
         * Array response from the fake api call to Profile endpoint.
         */
        $array = [
            'status' => true,
            'data' => [
                'userName' => 'user',
                'created_at' => time(),
                'updated_at' => time()
            ]
        ];

        /**
         * Mocks the HTTP Response
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
         * Calls the listAll() method.
         */
        $response = $this->profiles->listAll();

        /**
         * Assertions
         */
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('userName', $response['data']);
        $this->assertSame($response['data']['userName'], 'user');
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
}
