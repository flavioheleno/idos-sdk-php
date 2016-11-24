<?php

namespace Test\Unit\Endpoint\Profile;

use idOS\Endpoint\Profile\References;
use Test\Unit\AbstractUnit;

/**
 * ReferencesTest Class tests all methods from the References Class.
 */
class ReferencesTest extends AbstractUnit {
    /**
     * Profile references endpoint instance.
     */
    protected $references;

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

        $this->references = new References('dummyUserName', $this->auth, $this->httpClient, false);
    }

    public function testListAll() {
        /**
         * Array response from the fake api call to References endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                0 => [
                    'name'       => 'reference1',
                    'value'      => 'value1',
                    'created_at' => time(),
                    'updated_at' => time()
                ],
                1 => [
                    'name'       => 'reference2',
                    'value'      => 'value2',
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
        $response = $this->references->listAll();

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('name', $response['data'][0]);
        $this->assertSame('reference1', $response['data'][0]['name']);
        $this->assertArrayHasKey('value', $response['data'][0]);
        $this->assertSame('value1', $response['data'][0]['value']);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
        $this->assertArrayHasKey('name', $response['data'][1]);
        $this->assertSame('reference2', $response['data'][1]['name']);
        $this->assertArrayHasKey('value', $response['data'][1]);
        $this->assertSame('value2', $response['data'][1]['value']);
        $this->assertInternalType('int', $response['data'][1]['created_at']);
        $this->assertInternalType('int', $response['data'][1]['updated_at']);
    }

    public function testGetOne() {
        /**
         * Array response from the fake api call to References endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'name'       => 'reference1',
                'value'      => 'value1',
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
        $response = $this->references->getOne('reference1');

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('reference1', $response['data']['name']);
        $this->assertArrayHasKey('value', $response['data']);
        $this->assertSame('value1', $response['data']['value']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testCreateNew() {
        /**
         * Array response from the fake api call to References endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'name'       => 'reference1',
                'value'      => 'value1',
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
        $response = $this->references->createNew('reference1', 'value1');

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('reference1', $response['data']['name']);
        $this->assertArrayHasKey('value', $response['data']);
        $this->assertSame('value1', $response['data']['value']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testUpdateOne() {
        /**
         * Array response from the fake api call to References endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'name'       => 'reference1',
                'value'      => 'value1',
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
         * Calls the updateOne() method.
         */
        $response = $this->references->updateOne('reference1', 'value1');

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('reference1', $response['data']['name']);
        $this->assertArrayHasKey('value', $response['data']);
        $this->assertSame('value1', $response['data']['value']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testDeleteOne() {
        /**
         * Array response from the fake api call to References endpoint.
         */
        $array = [
            'status' => true
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
         * Calls the deleteOne() method.
         */
        $response = $this->references->deleteOne('reference1');

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
    }

    public function testDeleteAll() {
        /**
         * Array response from the fake api call to References endpoint.
         */
        $array = [
            'status'  => true,
            'deleted' => 5
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
         * Calls the deleteAll() method.
         */
        $response = $this->references->deleteAll();

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('deleted', $response);
        $this->assertEquals(5, $response['deleted']);
    }
}
