<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace Test\Unit\Endpoint\Profile;

use idOS\Endpoint\Profile\Process\Tasks;
use Test\Unit\AbstractUnit;
/**
 * TasksTest Class tests all methods from the Tasks Class.
 */
class TasksTest extends AbstractUnit
{
    /**
     * Process tasks endpoint instance.
     */
    protected $tasks;
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
        $this->tasks = new Tasks(123456, 'dummyUserName', $this->auth, $this->httpClient, false);
    }
    public function testListAll()
    {
        /**
         * Array response from the fake api call to Tasks endpoint.
         */
        $array = ['status' => true, 'data' => [0 => ['id' => 1822872842, 'name' => 'test', 'event' => 'user:created', 'running' => true, 'success' => true, 'created_at' => time(), 'updated_at' => time()]]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the listAll() method.
         */
        $response = $this->tasks->listAll();
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
        $this->assertSame('test', $response['data'][0]['name']);
        $this->assertArrayHasKey('event', $response['data'][0]);
        $this->assertSame('user:created', $response['data'][0]['event']);
        $this->assertArrayHasKey('running', $response['data'][0]);
        $this->assertTrue($response['data'][0]['running']);
        $this->assertArrayHasKey('success', $response['data'][0]);
        $this->assertTrue($response['data'][0]['success']);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
    }
    public function testCreateNew()
    {
        /**
         * Array response from the fake api call to Tasks endpoint.
         */
        $array = ['status' => true, 'data' => ['id' => 1822872842, 'name' => 'test', 'event' => 'user:created', 'running' => true, 'success' => true, 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the createNew() method.
         */
        $response = $this->tasks->createNew('test', 'user:created', true, true, 'dummy message');
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
        $this->assertSame('test', $response['data']['name']);
        $this->assertArrayHasKey('event', $response['data']);
        $this->assertSame('user:created', $response['data']['event']);
        $this->assertArrayHasKey('running', $response['data']);
        $this->assertTrue($response['data']['running']);
        $this->assertArrayHasKey('success', $response['data']);
        $this->assertTrue($response['data']['success']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
    public function testGetOne()
    {
        /**
         * Array response from the fake api call to Tasks endpoint.
         */
        $array = ['status' => true, 'data' => ['id' => 1822872842, 'name' => 'test', 'event' => 'user:created', 'running' => true, 'success' => true, 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the getOne() method.
         */
        $response = $this->tasks->getOne(1822872842);
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
        $this->assertSame('test', $response['data']['name']);
        $this->assertArrayHasKey('event', $response['data']);
        $this->assertSame('user:created', $response['data']['event']);
        $this->assertArrayHasKey('running', $response['data']);
        $this->assertTrue($response['data']['running']);
        $this->assertArrayHasKey('success', $response['data']);
        $this->assertTrue($response['data']['success']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
    public function testUpdateOne()
    {
        /**
         * Array response from the fake api call to Tasks endpoint.
         */
        $array = ['status' => true, 'data' => ['id' => 1822872842, 'name' => 'test', 'event' => 'user:created', 'running' => true, 'success' => true, 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the updateOne() method.
         */
        $response = $this->tasks->updateOne(1822872842, 'test', 'user:created', true, true, 'dummy message');
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
        $this->assertSame('test', $response['data']['name']);
        $this->assertArrayHasKey('event', $response['data']);
        $this->assertSame('user:created', $response['data']['event']);
        $this->assertArrayHasKey('running', $response['data']);
        $this->assertTrue($response['data']['running']);
        $this->assertArrayHasKey('success', $response['data']);
        $this->assertTrue($response['data']['success']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
}