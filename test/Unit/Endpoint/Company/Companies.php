<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace Test\Unit\Endpoint\Company;

use idOS\Endpoint\Company\Companies;
use Test\Unit\AbstractUnit;
class CompaniesTest extends AbstractUnit
{
    /**
     * Companies endpoint instance.
     */
    private $companies;
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
        $this->auth = new \idOS\Auth\IdentityToken($this->credentials['identityToken']);
        $this->companies = new Companies('dummy-company', $this->auth, $this->httpClient, false);
    }
    public function testCreateNew()
    {
        /**
         * Array response from the fake api call to Gates endpoint.
         */
        $array = ['status' => true, 'data' => ['name' => 'Dummy Company 2', 'slug' => 'dummy-company-2', 'public_key' => '8b5fe9db84e338b424ed6d59da3254a0', 'created_at' => time(), 'updated_at' => time()]];
        /**
         * Mocks the HTTP Response.
         */
        $this->httpResponse = $this->getMockBuilder('GuzzleHttp\\Psr7\\Response')->getMock();
        $this->httpResponse->method('getBody')->will($this->returnValue(json_encode($array)));
        $this->httpClient->method('request')->will($this->returnValue($this->httpResponse));
        /**
         * Calls the createNew() method.
         */
        $response = $this->companies->createNew('Dummy Company 2');
        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('name', $response['data']);
        $this->assertSame('Dummy Company 2', $response['data']['name']);
        $this->assertArrayHasKey('slug', $response['data']);
        $this->assertSame('dummy-company-2', $response['data']['slug']);
        $this->assertArrayHasKey('public_key', $response['data']);
        $this->assertSame('8b5fe9db84e338b424ed6d59da3254a0', $response['data']['public_key']);
        $this->assertInternalType('int', $response['data']['created_at']);
        $this->assertInternalType('int', $response['data']['updated_at']);
    }
}