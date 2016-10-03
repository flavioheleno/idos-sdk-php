<?php

namespace Test\Functional;

class FeaturesTest extends AbstractFunctional {
	protected function setUp() {
		parent::setUp();
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
