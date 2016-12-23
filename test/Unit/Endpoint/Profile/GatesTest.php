<?php

namespace Test\Unit\Endpoint\Profile;

use idOS\Endpoint\Profile\Gates;
use Test\Unit\AbstractUnit;

/**
 * GatesTest Class tests all methods from the Gates Class.
 */
class GatesTest extends AbstractUnit {
    /**
     * Profile gates endpoint instance.
     */
    protected $gates;

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

        $this->gates = new Gates('dummyUserName', $this->auth, $this->httpClient, false);
    }

    public function testListAll() {
        /**
         * Array response from the fake api call to Gates endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                0 => [
                    'name'              => '18+',
                    'slug'              => '18',
                    'confidence_level'  => 'high',
                    'created_at'        => time(),
                    'updated_at'        => time()
                ],
                1 => [
                    'name'              => 'gate slug',
                    'slug'              => 'gate-slug',
                    'confidence_level'  => 'medium',
                    'created_at'        => time(),
                    'updated_at'        => time()
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
        $response = $this->gates->listAll();

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('slug', $response['data'][0]);
        $this->assertSame('18', $response['data'][0]['slug']);
        $this->assertArrayHasKey('name', $response['data'][0]);
        $this->assertSame('18+', $response['data'][0]['name']);
        $this->assertArrayHasKey('confidence_level', $response['data'][0]);
        $this->assertSame('high', $response['data'][0]['confidence_level']);
        $this->assertArrayHasKey('slug', $response['data'][1]);
        $this->assertSame('gate-slug', $response['data'][1]['slug']);
        $this->assertArrayHasKey('name', $response['data'][1]);
        $this->assertSame('gate slug', $response['data'][1]['name']);
        $this->assertArrayHasKey('confidence_level', $response['data'][1]);
        $this->assertSame('medium', $response['data'][1]['confidence_level']);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
        $this->assertInternalType('int', $response['data'][1]['created_at']);
        $this->assertInternalType('int', $response['data'][1]['updated_at']);
    }

    public function testGetOne() {
        /**
         * Array response from the fake api call to Gates endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'name'             => '18+',
                'slug'             => '18',
                'confidence_level' => 'low',
                'created_at'       => time(),
                'updated_at'       => time()
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
        $response = $this->gates->getOne('18');

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('slug', $response['data']);
        $this->assertSame('18', $response['data']['slug']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('18+', $response['data']['name']);
        $this->assertArrayHasKey('confidence_level', $response['data']);
        $this->assertSame('low', $response['data']['confidence_level']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testCreateNew() {
        /**
         * Array response from the fake api call to Gates endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'name'             => '18+',
                'slug'             => '18',
                'confidence_level' => 'low',
                'created_at'       => time(),
                'updated_at'       => time()
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
        $response = $this->gates->createNew('18+', true);

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('slug', $response['data']);
        $this->assertSame('18', $response['data']['slug']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('18+', $response['data']['name']);
        $this->assertArrayHasKey('confidence_level', $response['data']);
        $this->assertSame('low', $response['data']['confidence_level']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testUpdateOne() {
        /**
         * Array response from the fake api call to Gates endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'name'             => '18+',
                'slug'             => '18',
                'confidence_level' => 'high',
                'created_at'       => time(),
                'updated_at'       => time()
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
        $response = $this->gates->updateOne('18', false);
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('slug', $response['data']);
        $this->assertSame('18', $response['data']['slug']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('18+', $response['data']['name']);
        $this->assertArrayHasKey('confidence_level', $response['data']);
        $this->assertSame('high', $response['data']['confidence_level']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testUpsertOne() {
        /**
         * Array response from the fake api call to Gates endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'name'             => '18+',
                'slug'             => '18',
                'confidence_level' => 'low',
                'created_at'       => time(),
                'updated_at'       => time()
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
        $response = $this->gates->upsertOne('18+', false);

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('slug', $response['data']);
        $this->assertSame('18', $response['data']['slug']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('18+', $response['data']['name']);
        $this->assertArrayHasKey('confidence_level', $response['data']);
        $this->assertSame('low', $response['data']['confidence_level']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testDeleteOne() {
        /**
         * Array response from the fake api call to Gates endpoint.
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
        $response = $this->gates->deleteOne('18');

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
    }

    public function testDeleteAll() {
        /**
         * Array response from the fake api call to Gates endpoint.
         */
        $array = [
            'status'  => true,
            'deleted' => 1
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
        $response = $this->gates->deleteAll();

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('deleted', $response);
        $this->assertEquals(1, $response['deleted']);
    }
}
