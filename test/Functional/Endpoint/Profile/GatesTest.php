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
            ->Gates->createNew('Name Test 1', true);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test 2', false);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->listAll();

        foreach ($response['data'] as $gate) {
            if ($gate['name'] === 'Name Test 1') {
                $this->assertSame('name-test-1', $gate['slug']);
                $this->assertTrue($gate['pass']);
            }

            if ($gate['name'] === 'Name Test 2') {
                $this->assertSame('name-test-2', $gate['slug']);
                $this->assertFalse($gate['pass']);
            }
        }
    }

    public function testCreateNew() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test', true, 'confidence-level');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('Name Test', $response['data']['name']);
        $this->assertSame('name-test-confidence-level', $response['data']['slug']);
        $this->assertTrue($response['data']['pass']);
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
            ->Gates->createNew('Name Test', true);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->getOne('name-test');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('Name Test', $response['data']['name']);
        $this->assertSame('name-test', $response['data']['slug']);
        $this->assertTrue($response['data']['pass']);
    }

    public function testUpdateOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test', true);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->updateOne('name-test', false);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('Name Test', $response['data']['name']);
        $this->assertSame('name-test', $response['data']['slug']);
        $this->assertFalse($response['data']['pass']);
    }

    public function testUpsertOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->upsertOne('Name Test', true, 'confidence-level');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('Name Test', $response['data']['name']);
        $this->assertSame('name-test-confidence-level', $response['data']['slug']);
        $this->assertTrue($response['data']['pass']);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->upsertOne('Name Test', false);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('Name Test', $response['data']['name']);
        $this->assertSame('name-test', $response['data']['slug']);
        $this->assertFalse($response['data']['pass']);
    }

    public function testDeleteOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test', true);

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
            ->Gates->createNew('Name Test 1', true);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test 2', false);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->createNew('Name Test 3', true);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Gates->deleteAll();

        $this->assertTrue($response['status']);
        $this->assertSame(3, $response['deleted']);
    }
}
