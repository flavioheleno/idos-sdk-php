<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace Test\Unit\Endpoint\Profile;

use idOS\Endpoint\Profile\Sources;
use Test\Unit\AbstractUnit;

/**
 * SourcesTest Class tests all methods from the Sources Class.
 */
class SourcesTest extends AbstractUnit
{
    /**
     * Profile sources endpoint instance.
     */
    protected $sources;
    protected function setUp()
    {
        parent::setUp();
        /**
         * GuzzleHttp\Client mock.
         */
        $this->httpClient = $this->getMockBuilder('GuzzleHttp\\Client')->getMock();
        /**
         * CredentialToken instance to instantiate the idOS\SDK Class.
         */
        $this->auth    = new \idOS\Auth\CredentialToken($this->credentials['userName'], $this->credentials['credentialPublicKey'], $this->credentials['credentialPrivKey']);
        $this->sources = new Sources('dummyUserName', $this->auth, $this->httpClient, false);
    }
    public function testListAll()
    {
        /**
         * Array response from the fake api call to Sources endpoint.
         */
        $array = ['status' => true, 'data' => [0 => ['id' => 1822872842, 'name' => 'email', 'tags' => ['test' => 'value-test', 'other' => 'other-tag'], 'created_at' => time(), 'updated_at' => time()]]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the listAll() method.
         */
        $response = $this->sources->listAll();
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('id', $response['data'][0]);
        $this->assertSame(1822872842, $response['data'][0]['id']);
        $this->assertArrayHasKey('name', $response['data'][0]);
        $this->assertSame('email', $response['data'][0]['name']);
        $this->assertArrayHasKey('tags', $response['data'][0]);
        $this->assertSame(['test' => 'value-test', 'other' => 'other-tag'], $response['data'][0]['tags']);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
    }
    public function testCreateNew()
    {
        /**
         * Array response from the fake api call to Sources endpoint.
         */
        $array = ['status' => true, 'data' => ['id' => 1822872842, 'name' => 'email', 'tags' => ['test' => 'value-test', 'other' => 'other-tag'], 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the createNew() method.
         */
        $response = $this->sources->createNew('email', ['test' => 'value-test', 'other' => 'other-tag']);
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('id', $response['data']);
        $this->assertSame(1822872842, $response['data']['id']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('email', $response['data']['name']);
        $this->assertArrayHasKey('tags', $response['data']);
        $this->assertSame(['test' => 'value-test', 'other' => 'other-tag'], $response['data']['tags']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
    public function testGetOne()
    {
        /**
         * Array response from the fake api call to Sources endpoint.
         */
        $array = ['status' => true, 'data' => ['id' => 1822872842, 'name' => 'email', 'tags' => ['test' => 'value-test', 'other' => 'other-tag'], 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the getOne() method.
         */
        $response = $this->sources->getOne(1822872842);
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('id', $response['data']);
        $this->assertSame(1822872842, $response['data']['id']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('email', $response['data']['name']);
        $this->assertArrayHasKey('tags', $response['data']);
        $this->assertSame(['test' => 'value-test', 'other' => 'other-tag'], $response['data']['tags']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
    public function testUpdateOne()
    {
        /**
         * Array response from the fake api call to Sources endpoint.
         */
        $array = ['status' => true, 'data' => ['id' => 1822872842, 'name' => 'email', 'tags' => ['test' => 'updated-test', 'other' => 'updated-tag'], 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the updateOne() method.
         */
        $response = $this->sources->updateOne(1822872842, ['test' => 'updated-test', 'other' => 'updated-tag']);
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('id', $response['data']);
        $this->assertSame(1822872842, $response['data']['id']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('email', $response['data']['name']);
        $this->assertArrayHasKey('tags', $response['data']);
        $this->assertSame(['test' => 'updated-test', 'other' => 'updated-tag'], $response['data']['tags']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
    public function testDeleteOne()
    {
        /**
         * Array response from the fake api call to Sources endpoint.
         */
        $array = ['status' => true];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the deleteOne() method.
         */
        $response = $this->sources->deleteOne(1822872842);
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
    }
    public function testDeleteAll()
    {
        /**
         * Array response from the fake api call to Sources endpoint.
         */
        $array = ['status' => true, 'deleted' => 7];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the deleteAll() method.
         */
        $response = $this->sources->deleteAll();
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('deleted', $response);
        $this->assertEquals(7, $response['deleted']);
    }
}
