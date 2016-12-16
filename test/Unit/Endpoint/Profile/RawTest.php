<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace Test\Unit\Endpoint\Profile;

use idOS\Endpoint\Profile\Raw;
use Test\Unit\AbstractUnit;

/**
 * RawTest Class tests all methods from the Raw Class.
 */
class RawTest extends AbstractUnit
{
    /**
     * Raw data endpoint instance.
     */
    protected $raw;
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
        $this->auth = new \idOS\Auth\CredentialToken($this->credentials['userName'], $this->credentials['credentialPublicKey'], $this->credentials['credentialPrivKey']);
        $this->raw  = new Raw('dummyUserName', $this->auth, $this->httpClient, false);
    }
    public function testListAll()
    {
        $sourceArray = ['id' => 1068368561, 'name' => 'name-test', 'tags' => ['tag-1' => 'value-1', 'tag-2' => 'value-2'], 'created_at' => time(), 'updated_at' => time()];
        /**
         * Array response from the fake api call to Raw endpoint.
         */
        $array = ['status' => true, 'data' => [0 => ['source' => $sourceArray, 'collection' => 'collection-name', 'data' => ['value' => 'test'], 'created_at' => time(), 'updated_at' => time()]]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the listAll() method.
         */
        $response = $this->raw->listAll();
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('source', $response['data'][0]);
        $this->assertSame($sourceArray, $response['data'][0]['source']);
        $this->assertArrayHasKey('collection', $response['data'][0]);
        $this->assertSame('collection-name', $response['data'][0]['collection']);
        $this->assertArrayHasKey('data', $response['data'][0]);
        $this->assertSame(['value' => 'test'], $response['data'][0]['data']);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
    }
    public function testCreateNew()
    {
        $sourceArray = ['id' => 1068368561, 'name' => 'name-test', 'tags' => ['tag-1' => 'value-1', 'tag-2' => 'value-2'], 'created_at' => time(), 'updated_at' => time()];
        /**
         * Array response from the fake api call to Raw endpoint.
         */
        $array = ['status' => true, 'data' => ['source' => $sourceArray, 'collection' => 'collection-name', 'data' => ['value' => 'test'], 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the createNew() method.
         */
        $response = $this->raw->createNew(1068368561, 'collection-name', ['value' => 'test']);
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('source', $response['data']);
        $this->assertSame($sourceArray, $response['data']['source']);
        $this->assertArrayHasKey('collection', $response['data']);
        $this->assertSame('collection-name', $response['data']['collection']);
        $this->assertArrayHasKey('data', $response['data']);
        $this->assertSame(['value' => 'test'], $response['data']['data']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
    public function testUpsertOne()
    {
        $sourceArray = ['id' => 1068368561, 'name' => 'name-test', 'tags' => ['tag-1' => 'value-1', 'tag-2' => 'value-2'], 'created_at' => time(), 'updated_at' => time()];
        /**
         * Array response from the fake api call to Raw endpoint.
         */
        $array = ['status' => true, 'data' => ['source' => $sourceArray, 'collection' => 'collection-name', 'data' => ['value' => 'test'], 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the upsertOne() method.
         */
        $response = $this->raw->upsertOne(1068368561, 'collection-name', ['value' => 'test']);
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('source', $response['data']);
        $this->assertSame($sourceArray, $response['data']['source']);
        $this->assertArrayHasKey('collection', $response['data']);
        $this->assertSame('collection-name', $response['data']['collection']);
        $this->assertArrayHasKey('data', $response['data']);
        $this->assertSame(['value' => 'test'], $response['data']['data']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
}
