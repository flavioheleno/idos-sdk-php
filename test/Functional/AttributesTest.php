<?php

namespace Test\Functional;

class AttributesTest extends AbstractFunctional {
	protected function setUp() {
		parent::setUp();
	}

	public function testCreateNew() {
		$response = $this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->createNew('name-test', 'value-test', 1.2);

		$this->assertTrue($response['status']);
		$this->assertNotEmpty($response['data']);
		$this->assertNotEmpty($response['data']['creator']);
		$this->assertSame('name-test', $response['data']['name']);
		$this->assertSame('value-test', $response['data']['value']);
		$this->assertSame(1.2, $response['data']['support']);
	}

	public function testCreateNewUtf8() {
		$response = $this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->createNew('námé-test', 'válué-test', 1.2);

		$this->assertFalse($response['status']);
		$this->assertNotEmpty($response['error']);
	}

	public function testGetOne() {
		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->deleteAll();

		$this->testCreateNew();

		$response = $this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->getOne('name-test');

		$this->assertTrue($response['status']);
		$this->assertNotEmpty($response['data']);

		$attributes = $response['data'];
		$attribute = array_pop($response['data']);
		$this->assertNotEmpty($attribute['creator']);
		$this->assertSame('name-test', $attribute['name']);
		$this->assertSame('value-test', $attribute['value']);
		$this->assertSame(1.2, $attribute['support']);
	}

	public function testDeleteOne() {
		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->deleteAll();

		$this->testCreateNew();

		$response = $this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->deleteOne('name-test');

		$this->assertTrue($response['status']);
		$this->assertSame(1, $response['deleted']);
	}

	public function testDeleteAll() {
		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->deleteAll();

		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->createNew('name-test-1', 'value-test-1', 1.2);
		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->createNew('name-test-2', 'value-test-2', 1.3);
		$this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->createNew('name-test-3', 'value-test-3', 1.4);

		$response = $this->sdk
		    ->Profile($this->credentials['username'])
		    ->Attributes->deleteAll();

		$this->assertTrue($response['status']);
		$this->assertSame(3, $response['deleted']);
	}
}
