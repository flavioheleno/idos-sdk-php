<?php

namespace Test\Functional;

class SourcesTest extends AbstractFunctional {
    protected function setUp() {
        parent::setUp();
    }

    public function testListAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->createNew('name-test-1', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);
        $test = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->createNew('name-test-2', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->listAll();

        foreach ($response['data'] as $source) {
            if ($source['name'] === 'name-test-1') {
                $this->assertSame(['tag-1' => 'value-1', 'tag-2' => 'value-2'], $source['tags']);
            }

            if ($source['name'] === 'name-test-2') {
                $this->assertSame(['tag-1' => 'value-1', 'tag-2' => 'value-2'], $source['tags']);
            }
        }
    }

    public function testCreateNew() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->createNew('name-test', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame(['tag-1' => 'value-1', 'tag-2' => 'value-2'], $response['data']['tags']);
    }

    public function testCreateNewUtf8() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->createNew('námé-test', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);

        $this->assertFalse($response['status']);
        $this->assertNotEmpty($response['error']);
    }

    public function testGetOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->deleteAll();

        $source = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->createNew('name-test', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->getOne($source['data']['id']);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame(['tag-1' => 'value-1', 'tag-2' => 'value-2'], $response['data']['tags']);
    }

    public function testUpdateOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->deleteAll();

        $source = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->createNew('name-test', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->updateOne($source['data']['id'], ['tag-1' => 'value-1', 'tag-2' => 'value-2', 'tag-3' => 'value-3']);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('name-test', $response['data']['name']);
        $this->assertSame(['tag-1' => 'value-1', 'tag-2' => 'value-2', 'tag-3' => 'value-3'], $response['data']['tags']);
    }

    public function testDeleteOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->deleteAll();

        $source = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->createNew('name-test', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->deleteOne($source['data']['id']);

        $this->assertTrue($response['status']);
    }

    public function testDeleteAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->createNew('name-test-1', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->createNew('name-test-2', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Sources->deleteAll();

        $this->assertTrue($response['status']);
        $this->assertSame(2, $response['deleted']);
    }
}
