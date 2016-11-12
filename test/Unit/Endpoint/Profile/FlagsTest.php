<?php

namespace Test\Unit\Endpoint\Profile;

use Test\Unit\AbstractUnitTest;
use idOS\Endpoint\Profile\Flags;

class FlagsTest extends AbstractUnitTest {

	private $Flags;

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

        $this->flags = new Flags('dummyUserName', $this->auth, $this->httpClient, false);
    }

    public function testListAll() {
        /**
         * Array response from the fake api call to Flags endpoint.
         */
        $array = [
            'status' => true,
            'data' => [
                0 => [
                    'slug' => 'flag-slug',
                    'attribute' => 'attr',
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
        $response = $this->flags->listAll();

        /**
         * Assertions
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);        $this->assertArrayHasKey('slug', $response['data'][0]);
        $this->assertSame('flag-slug', $response['data'][0]['slug']);
        $this->assertArrayHasKey('attribute', $response['data'][0]);
        $this->assertSame('attr', $response['data'][0]['attribute']);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
    }


    public function testGetOne() {
         /**
         * Array response from the fake api call to Flags endpoint.
         */
        $array = [
            'status' => true,
            'data' => [
                'slug' => 'flag-slug',
                'attribute' => 'attr',
                'created_at' => time(),
                'updated_at' => time()
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
         * Calls the getOne() method.
         */
        $response = $this->flags->getOne('flag-slug');

        /**
         * Assertions
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('slug', $response['data']);
        $this->assertSame('flag-slug', $response['data']['slug']);
        $this->assertArrayHasKey('attribute', $response['data']);
        $this->assertSame('attr', $response['data']['attribute']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function testCreateNew() {
        /**
         * Array response from the fake api call to Flags endpoint.
         */
        $array = [
            'status' => true,
            'data' => [
                'slug' => 'flag-slug',
                'attribute' => 'attr',
                'created_at' => time(),
                'updated_at' => time()
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
         * Calls the createNew() method.
         */
        $response = $this->flags->createNew('flag-slug', 'attr');

        /**
         * Assertions
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('slug', $response['data']);
        $this->assertSame('flag-slug', $response['data']['slug']);
        $this->assertArrayHasKey('attribute', $response['data']);
        $this->assertSame('attr', $response['data']['attribute']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }

    public function deleteOne() {
        /**
         * Array response from the fake api call to Flags endpoint.
         */
        $array = [
            'status' => true
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
         * Calls the deleteOne() method.
         */
        $response = $this->flags->deleteOne('flag-slug');

        /**
         * Assertions
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
    }

    public function deleteAll() {
         /**
         * Array response from the fake api call to Flags endpoint.
         */
        $array = [
            'status' => true,
            'deleted' => 2
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
         * Calls the deleteAll() method.
         */
        $response = $this->flags->deleteAll();

        /**
         * Assertions
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('deleted', $response);
        $this->assertEquals(2, $response['deleted']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
}
