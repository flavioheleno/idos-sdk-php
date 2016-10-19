<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class CandidatesTest extends AbstractFunctional {
    protected function setUp() {
        parent::setUp();
    }

    public function testListAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->createNew('name-test-1', 'value-test-1', 0.5);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->createNew('name-test-2', 'value-test-2', 0.6);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->listAll();

        foreach ($response['data'] as $attribute) {
            if ($attribute['name'] === 'name-test-1') {
                $this->assertSame('value-test-1', $attribute['value']);
                $this->assertSame(0.5, $attribute['support']);
            }

            if ($attribute['name'] === 'name-test-2') {
                $this->assertSame('value-test-2', $attribute['value']);
                $this->assertSame(0.6, $attribute['support']);
            }
        }
    }

    public function testCreateNew() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->createNew('name-test', 'value-test', 0.9);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame('value-test', $response['data']['value']);
        $this->assertSame(0.9, $response['data']['support']);
    }

    public function testCreateNewUtf8() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->createNew('námé-test', 'válué-test', 0.9);

        $this->assertFalse($response['status']);
        $this->assertNotEmpty($response['error']);
    }

    public function testGetOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->deleteAll();

        $this->testCreateNew();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->getOne('name-test');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);

        $attribute = array_pop($response['data']);
        $this->assertNotEmpty($attribute['creator']);
        $this->assertSame('name-test', $attribute['name']);
        $this->assertSame('value-test', $attribute['value']);
        $this->assertSame(0.9, $attribute['support']);
    }

    public function testDeleteOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->deleteAll();

        $this->testCreateNew();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->deleteOne('name-test');

        $this->assertTrue($response['status']);
        $this->assertSame(1, $response['deleted']);
    }

    public function testDeleteAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->createNew('name-test-1', 'value-test-1', 0.9);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->createNew('name-test-2', 'value-test-2', 0.6);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->createNew('name-test-3', 'value-test-3', 0.4);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->deleteAll();

        $this->assertTrue($response['status']);
        $this->assertSame(3, $response['deleted']);
    }
}
