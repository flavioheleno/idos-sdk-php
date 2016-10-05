<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class ProcessesTest extends AbstractFunctional {
    protected function setUp() {
        parent::setUp();
    }

    public function testListAll() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Processes->listAll();

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);

        foreach ($response['data'] as $process) {
            $this->assertInternalType('integer', $process['id']);
            $this->assertInternalType('string', $process['name']);
            $this->assertInternalType('string', $process['event']);
            $this->assertInternalType('integer', $process['created_at']);
        }
    }

    public function testGetOne() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Processes->getOne(1321189817);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame(1321189817, $response['data']['id']);
        $this->assertSame('idos:verification', $response['data']['name']);
        $this->assertSame('idos:source.facebook.created', $response['data']['event']);
        $this->assertInternalType('integer', $response['data']['created_at']);
    }
}
