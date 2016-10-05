<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class WarningsTest extends AbstractFunctional {
    protected function setUp() {
        parent::setUp();
    }

    public function testListAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->createNew('warning-test-1', 'attribute-test-1');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->createNew('warning-test-2', 'attribute-test-2');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->listAll();

        foreach ($response['data'] as $reference) {
            if ($reference['slug'] === 'warning-test-1') {
                $this->assertSame('attribute-test-1', $reference['attribute']);
            }

            if ($reference['slug'] === 'warning-test-2') {
                $this->assertSame('attribute-test-2', $reference['attribute']);
            }
        }
    }

    public function testCreateNew() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->createNew('warning-test', 'attribute-test');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('warning-test', $response['data']['slug']);
        $this->assertSame('attribute-test', $response['data']['attribute']);
    }

    public function testCreateNewUtf8() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->createNew('wárníng-test', 'áttríbúte-test');

        $this->assertFalse($response['status']);
        $this->assertNotEmpty($response['error']);
    }

    public function testGetOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->createNew('warning-test', 'attribute-test');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->getOne('warning-test');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('warning-test', $response['data']['slug']);
        $this->assertSame('attribute-test', $response['data']['attribute']);
    }

    public function testDeleteOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->deleteAll();

        $feature = $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->createNew('warning-test', 'attribute-test');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->deleteOne('warning-test');

        $this->assertTrue($response['status']);
    }

    public function testDeleteAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->createNew('warning-test-1', 'attribute-test-1');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->createNew('warning-test-2', 'attribute-test-2');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->createNew('warning-test-3', 'attribute-test-3');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Warnings->deleteAll();

        $this->assertTrue($response['status']);
        $this->assertSame(3, $response['deleted']);
    }
}
