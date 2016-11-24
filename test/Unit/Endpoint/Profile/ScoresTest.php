<?php

namespace Test\Unit\Endpoint\Profile;

use idOS\Endpoint\Profile\Scores;
use Test\Unit\AbstractUnit;

/**
 * ScoresTest Class tests all methods from the Scores Class.
 */
class ScoresTest extends AbstractUnit {
    /**
     * Profile scores endpoint instance.
     */
    protected $scores;

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

        $this->scores = new Scores('dummyUserName', $this->auth, $this->httpClient, false);
    }

    public function testListAll() {
        /**
         * Array response from the fake api call to Scores endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                0 => [
                    'creator' => [
                    'name' => 'idOS Scraper'
                    ],
                    'attribute'  => 'firstName',
                    'name'       => 'Jhon',
                    'value'      => 0.3,
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
        $response = $this->scores->listAll();

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('creator', $response['data'][0]);
        $this->assertSame(['name' => 'idOS Scraper'], $response['data'][0]['creator']);
        $this->assertArrayHasKey('attribute', $response['data'][0]);
        $this->assertSame('firstName', $response['data'][0]['attribute']);
        $this->assertArrayHasKey('value', $response['data'][0]);
        $this->assertSame(0.3, $response['data'][0]['value']);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
    }

    public function testCreateNew() {
        /**
         * Array response from the fake api call to Scores endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'creator' => [
                    'name' => 'idOS Scraper'
                ],
                'attribute'  => 'firstName',
                'name'       => 'Jhon',
                'value'      => 0.3,
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
        $response = $this->scores->createNew('firstName', 'Jhon', 0.3);

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('creator', $response['data']);
        $this->assertSame(['name' => 'idOS Scraper'], $response['data']['creator']);
        $this->assertArrayHasKey('attribute', $response['data']);
        $this->assertSame('firstName', $response['data']['attribute']);
        $this->assertArrayHasKey('value', $response['data']);
        $this->assertSame(0.3, $response['data']['value']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testGetOne() {
        /**
         * Array response from the fake api call to Scores endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'creator' => [
                    'name' => 'idOS Scraper'
                ],
                'attribute'  => 'firstName',
                'name'       => 'Jhon',
                'value'      => 0.3,
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
        $response = $this->scores->getOne('Jhon');

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('creator', $response['data']);
        $this->assertSame(['name' => 'idOS Scraper'], $response['data']['creator']);
        $this->assertArrayHasKey('attribute', $response['data']);
        $this->assertSame('firstName', $response['data']['attribute']);
        $this->assertArrayHasKey('value', $response['data']);
        $this->assertSame(0.3, $response['data']['value']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testUpsertOne() {
        /**
         * Array response from the fake api call to Scores endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'creator' => [
                    'name' => 'idOS Scraper'
                ],
                'attribute'  => 'firstName',
                'name'       => 'Jhon',
                'value'      => 0.5,
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
        $response = $this->scores->upsertOne('firstName', 'Jhon', 0.5);

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('creator', $response['data']);
        $this->assertSame(['name' => 'idOS Scraper'], $response['data']['creator']);
        $this->assertArrayHasKey('attribute', $response['data']);
        $this->assertSame('firstName', $response['data']['attribute']);
        $this->assertArrayHasKey('value', $response['data']);
        $this->assertSame(0.5, $response['data']['value']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testUpdateOne() {
        /**
         * Array response from the fake api call to Scores endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'creator' => [
                    'name' => 'idOS Scraper'
                ],
                'attribute'  => 'firstName',
                'name'       => 'Jhon',
                'value'      => 0.5,
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
        $response = $this->scores->updateOne('firstName', 'Jhon', 0.5);

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('creator', $response['data']);
        $this->assertSame(['name' => 'idOS Scraper'], $response['data']['creator']);
        $this->assertArrayHasKey('attribute', $response['data']);
        $this->assertSame('firstName', $response['data']['attribute']);
        $this->assertArrayHasKey('value', $response['data']);
        $this->assertSame(0.5, $response['data']['value']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
    public function testDeleteOne() {
        /**
         * Array response from the fake api call to Scores endpoint.
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
        $response = $this->scores->deleteOne('Jhon');

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
    }

    public function testDeleteAll() {
        /**
         * Array response from the fake api call to Scores endpoint.
         */
        $array = [
            'status'  => true,
            'deleted' => 11
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
        $response = $this->scores->deleteAll();

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('deleted', $response);
        $this->assertEquals(11, $response['deleted']);
    }
}
