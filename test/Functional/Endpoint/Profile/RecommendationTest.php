<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class RecommendationTest extends AbstractFunctional {
    protected function setUp() {
        parent::setUp();
    }
    
    public function testUpsertOne() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Recommendation->upsertOne('pass', [], []);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['result']);
        $this->assertSame('pass', $response['data']['result']);
        $this->assertSame([], $response['data']['passed']);
        $this->assertSame([], $response['data']['failed']);
    }
 
    public function testGetOne() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Recommendation->getOne();

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['result']);
        $this->assertSame('pass', $response['data']['result']);
        $this->assertSame([], $response['data']['passed']);
        $this->assertSame([], $response['data']['failed']);
    }
}