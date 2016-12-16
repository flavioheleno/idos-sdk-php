<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace Test\Unit\Endpoint\Profile;

use idOS\Endpoint\Profile\Processes;
use idOS\Section\Profile;
use Test\Unit\AbstractUnit;

/**
 * ProcessesTest Class tests all methods from the Processes Class.
 */
class ProcessesTest extends AbstractUnit
{
    /**
     * Profile processes endpoint instance.
     */
    protected $processes;
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
        $this->auth      = new \idOS\Auth\CredentialToken($this->credentials['userName'], $this->credentials['credentialPublicKey'], $this->credentials['credentialPrivKey']);
        $this->processes = new Processes('dummyUserName', $this->auth, $this->httpClient, false);
    }
    public function testListAll()
    {
        /**
         * Array response from the fake api call to Processes endpoint.
         */
        $array = ['status' => true, 'data' => [0 => ['id' => 7854963, 'name' => 'process1', 'event' => ['idos:source.sms.verified'], 'created_at' => time(), 'updated_at' => time()], 1 => ['id' => 4347294, 'name' => 'process2', 'event' => ['idos:feature.profile.created'], 'created_at' => time(), 'updated_at' => time()]]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the listAll() method.
         */
        $response = $this->processes->listAll();
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('id', $response['data'][0]);
        $this->assertSame(7854963, $response['data'][0]['id']);
        $this->assertArrayHasKey('name', $response['data'][0]);
        $this->assertSame('process1', $response['data'][0]['name']);
        $this->assertArrayHasKey('event', $response['data'][0]);
        $this->assertNotEmpty($response['data'][0]['event']);
        $this->assertSame('idos:source.sms.verified', $response['data'][0]['event'][0]);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
        $this->assertArrayHasKey('id', $response['data'][1]);
        $this->assertSame(4347294, $response['data'][1]['id']);
        $this->assertArrayHasKey('name', $response['data'][1]);
        $this->assertSame('process2', $response['data'][1]['name']);
        $this->assertArrayHasKey('event', $response['data'][1]);
        $this->assertNotEmpty($response['data'][1]['event']);
        $this->assertSame('idos:feature.profile.created', $response['data'][1]['event'][0]);
        $this->assertInternalType('int', $response['data'][1]['created_at']);
        $this->assertInternalType('int', $response['data'][1]['updated_at']);
    }
    public function testGetOne()
    {
        /**
         * Array response from the fake api call to Processes endpoint.
         */
        $array = ['status' => true, 'data' => ['id' => 7854963, 'name' => 'process1', 'event' => ['idos:source.sms.verified'], 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the getOne() method.
         */
        $response = $this->processes->getOne(7854963);
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('id', $response['data']);
        $this->assertSame(7854963, $response['data']['id']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('process1', $response['data']['name']);
        $this->assertArrayHasKey('event', $response['data']);
        $this->assertNotEmpty($response['data']['event']);
        $this->assertSame('idos:source.sms.verified', $response['data']['event'][0]);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
}
