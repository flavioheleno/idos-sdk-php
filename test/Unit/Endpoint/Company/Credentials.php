<?php

namespace Test\Unit\Endpoint\Company;

use idOS\Endpoint\Company\Credentials;
use Test\Unit\AbstractUnit;

class CredentialsTest extends AbstractUnit {
    /**
     * Credentials endpoint instance.
     */
    private $credentialsEndpoint;

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
        $this->auth = new \idOS\Auth\IdentityToken(
            $this->credentials['identityToken']
        );

        $this->credentialsEndpoint = new Credentials('dummy-company', $this->auth, $this->httpClient, false);
    }

    public function testListAll() {
        /**
         * Array response from the mock API call to credentials endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                0 => [
                    'company_id' => 4564658766,
                    'name'       => 'My Test Key',
                    'slug'       => 'my-test-key',
                    'public'     => '4c9184f37cff01bcdc32dc486ec36961',
                    'private'    => '2c17c6393771ee3048ae34d6b380c5ec',
                    'production' => 0,
                    'special'    => 1,
                    'created_at' => time(),
                    'updated_at' => time()
                ]
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
         * Calls the listAll() method.
         */
        $response = $this->credentialsEndpoint->listAll();

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);

        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);

        $this->assertArrayHasKey('company_id', $response['data'][0]);
        $this->assertSame(4564658766, $response['data'][0]['company_id']);

        $this->assertArrayHasKey('name', $response['data'][0]);
        $this->assertSame('My Test Key', $response['data'][0]['name']);

        $this->assertArrayHasKey('slug', $response['data'][0]);
        $this->assertSame('my-test-key', $response['data'][0]['slug']);

        $this->assertArrayHasKey('public', $response['data'][0]);
        $this->assertSame('4c9184f37cff01bcdc32dc486ec36961', $response['data'][0]['public']);

        $this->assertArrayHasKey('private', $response['data'][0]);
        $this->assertSame('2c17c6393771ee3048ae34d6b380c5ec', $response['data'][0]['private']);

        $this->assertInternalType('int', $response['data'][0]['production']);
        $this->assertSame(0, $response['data'][0]['production']);

        $this->assertInternalType('int', $response['data'][0]['special']);
        $this->assertSame(1, $response['data'][0]['special']);

        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
    }

    public function testCreateNew() {
        /**
         * Array response from the fake api call to Gates endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'company_id' => 4564658766,
                'name'       => 'My Test Key',
                'slug'       => 'my-test-key',
                'public'     => '4c9184f37cff01bcdc32dc486ec36961',
                'private'    => '2c17c6393771ee3048ae34d6b380c5ec',
                'production' => 0,
                'special'    => 1,
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
         * Calls the createNew() method.
         */
        $response = $this->credentialsEndpoint->createNew('My Test Key', false);

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);

        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);

        $this->assertArrayHasKey('company_id', $response['data']);
        $this->assertSame(4564658766, $response['data']['company_id']);

        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('My Test Key', $response['data']['name']);

        $this->assertArrayHasKey('slug', $response['data']);
        $this->assertSame('my-test-key', $response['data']['slug']);

        $this->assertArrayHasKey('public', $response['data']);
        $this->assertSame('4c9184f37cff01bcdc32dc486ec36961', $response['data']['public']);

        $this->assertArrayHasKey('private', $response['data']);
        $this->assertSame('2c17c6393771ee3048ae34d6b380c5ec', $response['data']['private']);

        $this->assertInternalType('int', $response['data']['production']);
        $this->assertSame(0, $response['data']['production']);

        $this->assertInternalType('int', $response['data']['special']);
        $this->assertSame(1, $response['data']['special']);

        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
}
