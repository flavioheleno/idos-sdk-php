<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class ReferencesTest extends AbstractFunctional {
    protected function setUp() {
        parent::setUp();
    }

    public function testListAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('name-test-1', 'value-test-1');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('name-test-2', 'value-test-2');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->References->listAll();

        foreach ($response['data'] as $reference) {
            if ($reference['name'] === 'name-test-1') {
                $this->assertSame('value-test-1', $reference['value']);
            }

            if ($reference['name'] === 'name-test-2') {
                $this->assertSame('value-test-2', $reference['value']);
            }
        }
    }

    public function testCreateNew() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('name-test', 'value-test');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame('value-test', $response['data']['value']);
    }

    public function testCreateNewNameUtf8() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('námé-test', 'válué-test');

        $this->assertFalse($response['status']);
        $this->assertNotEmpty($response['error']);
    }

    public function testCreateNewValueUtf8() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('test', 'válué-test');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('test', $response['data']['name']);
        $this->assertSame('válué-test', $response['data']['value']);
    }

    public function testGetOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('name-test', 'value-test');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->References->getOne('name-test');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame('value-test', $response['data']['value']);
    }

    public function testUpdateOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('name-test', 'value-test');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->References->updateOne('name-test', 'value-test-changed');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame('value-test-changed', $response['data']['value']);
    }

    public function testDeleteOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('name-test', 'value-test');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->References->deleteOne('name-test');

        $this->assertTrue($response['status']);
    }

    public function testDeleteAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('name-test-1', 'value-test-1');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('name-test-2', 'value-test-2');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->References->createNew('name-test-3', 'value-test-3');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->References->deleteAll();

        $this->assertTrue($response['status']);
        $this->assertSame(3, $response['deleted']);
    }
}
