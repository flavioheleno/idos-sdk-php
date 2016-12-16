<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class FlagsTest extends AbstractFunctional
{
    protected function setUp()
    {
        parent::setUp();
    }
    public function testListAll()
    {
        $this->sdk->Profile($this->credentials['username'])->Flags->deleteAll();
        $this->sdk->Profile($this->credentials['username'])->Flags->createNew('flag-test-1', 'attribute-test-1');
        $this->sdk->Profile($this->credentials['username'])->Flags->createNew('flag-test-2', 'attribute-test-2');
        $response = $this->sdk->Profile($this->credentials['username'])->Flags->listAll();
        foreach ($response['data'] as $reference) {
            if ($reference['slug'] === 'flag-test-1') {
                $this->assertSame('attribute-test-1', $reference['attribute']);
            }
            if ($reference['slug'] === 'flag-test-2') {
                $this->assertSame('attribute-test-2', $reference['attribute']);
            }
        }
    }
    public function testCreateNew()
    {
        $this->sdk->Profile($this->credentials['username'])->Flags->deleteAll();
        $response = $this->sdk->Profile($this->credentials['username'])->Flags->createNew('flag-test', 'attribute-test');
        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('flag-test', $response['data']['slug']);
        $this->assertSame('attribute-test', $response['data']['attribute']);
    }
    public function testCreateNewUtf8()
    {
        $response = $this->sdk->Profile($this->credentials['username'])->Flags->createNew('wárníng-test', 'áttríbúte-test');
        $this->assertFalse($response['status']);
        $this->assertNotEmpty($response['error']);
    }
    public function testGetOne()
    {
        $this->sdk->Profile($this->credentials['username'])->Flags->deleteAll();
        $this->sdk->Profile($this->credentials['username'])->Flags->createNew('flag-test', 'attribute-test');
        $response = $this->sdk->Profile($this->credentials['username'])->Flags->getOne('flag-test');
        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('flag-test', $response['data']['slug']);
        $this->assertSame('attribute-test', $response['data']['attribute']);
    }
    public function testDeleteOne()
    {
        $this->sdk->Profile($this->credentials['username'])->Flags->deleteAll();
        $feature  = $this->sdk->Profile($this->credentials['username'])->Flags->createNew('flag-test', 'attribute-test');
        $response = $this->sdk->Profile($this->credentials['username'])->Flags->deleteOne('flag-test');
        $this->assertTrue($response['status']);
    }
    public function testDeleteAll()
    {
        $this->sdk->Profile($this->credentials['username'])->Flags->deleteAll();
        $this->sdk->Profile($this->credentials['username'])->Flags->createNew('flag-test-1', 'attribute-test-1');
        $this->sdk->Profile($this->credentials['username'])->Flags->createNew('flag-test-2', 'attribute-test-2');
        $this->sdk->Profile($this->credentials['username'])->Flags->createNew('flag-test-3', 'attribute-test-3');
        $response = $this->sdk->Profile($this->credentials['username'])->Flags->deleteAll();
        $this->assertTrue($response['status']);
        $this->assertSame(3, $response['deleted']);
    }
}
