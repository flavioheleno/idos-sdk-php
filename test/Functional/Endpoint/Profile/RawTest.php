<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class RawTest extends AbstractFunctional {
	protected function setUp() {
		parent::setUp();
	}

	public function testListAll() {
		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Raw->deleteAll();

		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Raw->createNew(1321189817, 'name-test-1', ['data-1' => [1, 2, 3], 'data-2' => [4, 5, 6]]);
		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Raw->createNew(1321189817, 'name-test-2', ['data-1' => [4, 5, 6], 'data-2' => [1, 2, 3]]);

		$response = $this->sdk
		    ->Profile($this->credentials['username'])
		    ->Raw->listAll();

		foreach ($response['data'] as $raw) {
			if ($raw['collection'] === 'name-test-1') {
			    $this->assertNotEmpty($raw['source']);
				$this->assertSame(['data-1' => [1, 2, 3], 'data-2' => [4, 5, 6]], $raw['data']);
            }

			if ($raw['collection'] === 'name-test-2') {
                $this->assertNotEmpty($raw['source']);
                $this->assertSame(['data-1' => [4, 5, 6], 'data-2' => [1, 2, 3]], $raw['data']);
			}
		}
	}

	public function testCreateNew() {
		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Raw->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Raw->createNew(1321189817, 'name-test', ['data-1' => [1, 2, 3], 'data-2' => [4, 5, 6]]);

		$this->assertTrue($response['status']);
		$this->assertNotEmpty($response['data']);
		$this->assertNotEmpty($response['data']['source']);
		$this->assertSame(['data-1' => [1, 2, 3], 'data-2' => [4, 5, 6]], $response['data']['data']);
	}

	public function testCreateNewUtf8() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Raw->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Raw->createNew(1321189817, 'name-test', ['dátá-1' => [1, 2, 3], 'dátá-2' => [4, 5, 6]]);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['source']);
        $this->assertSame(['dátá-1' => [1, 2, 3], 'dátá-2' => [4, 5, 6]], $response['data']['data']);
	}

	public function testUpsertOne() {
		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Raw->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Raw->createNew(1321189817, 'name-test', ['data-1' => [1, 2, 3], 'data-2' => [4, 5, 6]]);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['source']);
        $this->assertSame(['data-1' => [1, 2, 3], 'data-2' => [4, 5, 6]], $response['data']['data']);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Raw->upsertOne(1321189817, 'name-test', ['data-1' => [4, 5, 6], 'data-2' => [1, 2, 3]]);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['source']);
        $this->assertSame(['data-1' => [4, 5, 6], 'data-2' => [1, 2, 3]], $response['data']['data']);
	}

	public function testDeleteAll() {
		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Raw->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Raw->createNew(1321189817, 'name-test-1', ['data-1' => [1, 2, 3], 'data-2' => [4, 5, 6]]);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Raw->createNew(1321189817, 'name-test-2', ['data-1' => [4, 5, 6], 'data-2' => [1, 2, 3]]);

		$response = $this->sdk
		    ->Profile($this->credentials['username'])
		    ->Raw->deleteAll();

		$this->assertTrue($response['status']);
		$this->assertSame(2, $response['deleted']);
	}
}
