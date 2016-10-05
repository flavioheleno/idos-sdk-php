<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class FeaturesTest extends AbstractFunctional {
    protected function setUp() {
        parent::setUp();
    }

    public function testListAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test-1', 'value-test-1', 'string');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test-2', 3, 'integer');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->listAll();

        foreach ($response['data'] as $feature) {
            if ($feature['name'] === 'name-test-1') {
                $this->assertSame('value-test-1', $feature['value']);
                $this->assertSame('string', $feature['type']);
            }

            if ($feature['name'] === 'name-test-2') {
                $this->assertSame(3, $feature['value']);
                $this->assertSame('integer', $feature['type']);
            }
        }
    }

    public function testCreateNew() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test', 'value-test', 'string');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('facebook', $response['data']['source']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame('value-test', $response['data']['value']);
        $this->assertSame('string', $response['data']['type']);
    }

    public function testCreateNewUtf8() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'námé-test', 'válué-test', 1.2);

        $this->assertFalse($response['status']);
        $this->assertNotEmpty($response['error']);
    }

    public function testGetOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->deleteAll();

        $feature = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test', 'value-test', 'string');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->getOne($feature['data']['id']);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('facebook', $response['data']['source']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame('value-test', $response['data']['value']);
        $this->assertSame('string', $response['data']['type']);
    }

    public function testUpdateOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->deleteAll();

        $feature = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test', 'value-test', 'string');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->updateOne($feature['data']['id'], 2, 'integer');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('facebook', $response['data']['source']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame(2, $response['data']['value']);
        $this->assertSame('integer', $response['data']['type']);
    }

    public function testUpsertOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->upsertOne(1321189817, 'name-test', 'value-test', 'string');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('facebook', $response['data']['source']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame('value-test', $response['data']['value']);
        $this->assertSame('string', $response['data']['type']);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->upsertOne(1321189817, 'name-test', 2, 'integer');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('facebook', $response['data']['source']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame(2, $response['data']['value']);
        $this->assertSame('integer', $response['data']['type']);
    }

    public function testUpsertBulk() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test-1', 'value-test-1', 'string');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test-2', 3, 'integer');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->upsertBulk(
                [
                ['source_id' => 1321189817,
                'name'       => 'name-test-1',
                'value'      => 'value-test-1-changed',
                'type'       => 'string'],

                ['source_id' => 1321189817,
                'name'       => 'name-test-2',
                'value'      => 'value-test-2-changed',
                'type'       => 'string'],

                ['source_id' => 1321189817,
                'name'       => 'name-test-3',
                'value'      => 'value-test-3-changed',
                'type'       => 'string']
                ]
            );

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->listAll();

        foreach ($response['data'] as $feature) {
            if ($feature['name'] === 'name-test-1') {
                $this->assertSame('value-test-1-changed', $feature['value']);
                $this->assertSame('string', $feature['type']);
            }

            if ($feature['name'] === 'name-test-2') {
                $this->assertSame('value-test-2-changed', $feature['value']);
                $this->assertSame('string', $feature['type']);
            }

            if ($feature['name'] === 'name-test-3') {
                $this->assertSame('value-test-3-changed', $feature['value']);
                $this->assertSame('string', $feature['type']);
            }
        }
    }

    public function testDeleteOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->deleteAll();

        $feature = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test', 'value-test', 'string');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->deleteOne($feature['data']['id']);

        $this->assertTrue($response['status']);
    }

    public function testDeleteAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test-1', 'value-test-1', 'string');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test-2', 3, 'integer');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->createNew(1321189817, 'name-test-3', 2.2, 'float');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Features->deleteAll();

        $this->assertTrue($response['status']);
        $this->assertSame(3, $response['deleted']);
    }
}
