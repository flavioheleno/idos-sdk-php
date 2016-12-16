<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace Test\Unit\Endpoint\Company;

use idOS\Endpoint\Company\Settings;
use Test\Unit\AbstractUnit;

class SettingsTest extends AbstractUnit
{
    /**
     * Settings endpoint instance.
     */
    private $settings;
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
        $this->auth     = new \idOS\Auth\IdentityToken($this->credentials['identityToken']);
        $this->settings = new Settings('dummy-company', $this->auth, $this->httpClient, false);
    }
    public function testListAll()
    {
        /**
         * Array response from the mock API call to credentials endpoint.
         */
        $array = ['status' => true, 'data' => [0 => ['company_id' => 4564658766, 'section' => 'DummySection', 'property' => 'dummy.property', 'value' => 'dummy value', 'created_at' => time(), 'updated_at' => time()]]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the listAll() method.
         */
        $response = $this->settings->listAll();
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
        $this->assertArrayHasKey('section', $response['data'][0]);
        $this->assertSame('DummySection', $response['data'][0]['section']);
        $this->assertArrayHasKey('property', $response['data'][0]);
        $this->assertSame('dummy.property', $response['data'][0]['property']);
        $this->assertArrayHasKey('value', $response['data'][0]);
        $this->assertSame('dummy value', $response['data'][0]['value']);
        $this->assertInternalType('int', $response['data'][0]['created_at']);
        $this->assertInternalType('int', $response['data'][0]['updated_at']);
    }
    public function testCreateNew()
    {
        /**
         * Array response from the fake api call to Gates endpoint.
         */
        $array = ['status' => true, 'data' => ['company_id' => 4564658766, 'section' => 'DummySection', 'property' => 'dummy.property', 'value' => 'dummy value', 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the createNew() method.
         */
        $response = $this->settings->createNew('DummySection', 'dummy.property', 'dummy value', false);
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
        $this->assertArrayHasKey('section', $response['data']);
        $this->assertSame('DummySection', $response['data']['section']);
        $this->assertArrayHasKey('property', $response['data']);
        $this->assertSame('dummy.property', $response['data']['property']);
        $this->assertArrayHasKey('value', $response['data']);
        $this->assertSame('dummy value', $response['data']['value']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
}
