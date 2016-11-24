<?php

namespace Test\Unit\Endpoint\Company;

use idOS\Endpoint\Company\Widgets;
use Test\Unit\AbstractUnit;

class WidgetsTest extends AbstractUnit {
    /**
     * Widgets endpoint instance.
     */
    private $widgets;

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
        $this->auth = new \idOS\Auth\IdentityToken(
            $this->credentials['identityToken']
        );

        $this->widgets = new Widgets('dummy-company', $this->auth, $this->httpClient, false);
    }

    public function testListAll() {
        /**
         * Array response from the mock API call to widgets endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                0 => [
                    'hash'          => 'b863d45ef489ab31ed9571a951375717',
                    'label'         => 'Dummy Widget',
                    'type'          => 'embedded-widget',
                    'config'        => json_encode(['gates' => 'gate_1']),
                    'creator_id'    => 263517634,
                    'company_id'    => 139419876,
                    'credential_id' => 113981357
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
        $response = $this->widgets->listAll();

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);
        
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        
        $this->assertArrayHasKey('hash', $response['data'][0]);
        $this->assertSame('b863d45ef489ab31ed9571a951375717', $response['data'][0]['hash']);
        
        $this->assertArrayHasKey('label', $response['data'][0]);
        $this->assertSame('Dummy Widget', $response['data'][0]['label']);

        $this->assertArrayHasKey('type', $response['data'][0]);
        $this->assertSame('embedded-widget', $response['data'][0]['type']);

        $this->assertArrayHasKey('config', $response['data'][0]);
        $this->assertSame(json_encode(['gates' => 'gate_1']), $response['data'][0]['config']);
        
        $this->assertInternalType('int', $response['data'][0]['creator_id']);
        $this->assertSame(263517634, $response['data'][0]['creator_id']);

        $this->assertInternalType('int', $response['data'][0]['company_id']);
        $this->assertSame(139419876, $response['data'][0]['company_id']);

        $this->assertInternalType('int', $response['data'][0]['credential_id']);
        $this->assertSame(113981357, $response['data'][0]['credential_id']);
    }

    public function testGetOne() {
        /**
         * Array response from the mock API call to widgets endpoint.
         */
        $array = [
            'status' => true,
            'data'   => [
                'hash'          => 'b863d45ef489ab31ed9571a951375717',
                'label'         => 'Dummy Widget',
                'type'          => 'embedded-widget',
                'config'        => json_encode(['gates' => 'gate_1']),
                'creator_id'    => 263517634,
                'company_id'    => 139419876,
                'credential_id' => 113981357
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
        $response = $this->widgets->getOne('b863d45ef489ab31ed9571a951375717');

        /**
         * Assertions.
         */
        $this->assertNotEmpty($response);

        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);

        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);

        $this->assertArrayHasKey('hash', $response['data']);
        $this->assertSame('b863d45ef489ab31ed9571a951375717', $response['data']['hash']);
        
        $this->assertArrayHasKey('label', $response['data']);
        $this->assertSame('Dummy Widget', $response['data']['label']);

        $this->assertArrayHasKey('type', $response['data']);
        $this->assertSame('embedded-widget', $response['data']['type']);

        $this->assertArrayHasKey('config', $response['data']);
        $this->assertSame(json_encode(['gates' => 'gate_1']), $response['data']['config']);
        
        $this->assertInternalType('int', $response['data']['creator_id']);
        $this->assertSame(263517634, $response['data']['creator_id']);

        $this->assertInternalType('int', $response['data']['company_id']);
        $this->assertSame(139419876, $response['data']['company_id']);

        $this->assertInternalType('int', $response['data']['credential_id']);
        $this->assertSame(113981357, $response['data']['credential_id']);
    }
}
