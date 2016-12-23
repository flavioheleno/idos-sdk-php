<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class GatesTest extends AbstractFunctional {
    protected function setUp() {
        parent::setUp();
    }

    public function testListAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test 1', 'low');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test 2', 'medium');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->listAll();

        foreach ($response['data'] as $gate) {
            if ($gate['name'] === 'Name Test 1') {
                $this->assertSame('name-test-1', $gate['slug']);
                $this->assertSame('low', $gate['confidence_level']);
            }

            if ($gate['name'] === 'Name Test 2') {
                $this->assertSame('name-test-2', $gate['slug']);
                $this->assertSame('medium', $gate['confidence_level']);
            }
        }
    }

    public function testCreateNew() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test', 'high');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('Name Test', $response['data']['name']);
        $this->assertSame('name-test', $response['data']['slug']);
        $this->assertSame('high', $response['data']['confidence_level']);
    }

    public function testCreateNewUtf8() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Náme Tést', true);

        $this->assertFalse($response['status']);
        $this->assertNotEmpty($response['error']);
    }

    public function testGetOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test', 'high');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->getOne('name-test');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('Name Test', $response['data']['name']);
        $this->assertSame('name-test', $response['data']['slug']);
        $this->assertSame('high', $response['data']['confidence_level']);
    }

    public function testUpdateOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test', 'high');
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->updateOne('name-test', 'medium');
        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('Name Test', $response['data']['name']);
        $this->assertSame('name-test', $response['data']['slug']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('medium', $response['data']['confidence_level']);
    }

    public function testUpsertOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->upsertOne('Name Test', 'high');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('Name Test', $response['data']['name']);
        $this->assertSame('name-test', $response['data']['slug']);
        $this->assertSame('high', $response['data']['confidence_level']);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->upsertOne('Name Test1', 'low');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('Name Test1', $response['data']['name']);
        $this->assertSame('name-test1', $response['data']['slug']);
        $this->assertSame('low', $response['data']['confidence_level']);
    }

    public function testDeleteOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test', 'low');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteOne('name-test');

        $this->assertTrue($response['status']);
    }

    public function testDeleteAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test 1', 'low');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test 2', 'medium');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test 3', 'high');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $this->assertTrue($response['status']);
        $this->assertSame(3, $response['deleted']);
    }
}
