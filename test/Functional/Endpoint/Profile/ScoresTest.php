<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class ScoresTest extends AbstractFunctional {
    protected function setUp() {
        parent::setUp();
    }

    public function testListAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('attribute-name-1', 'score-1', 0.9);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('attribute-name-2', 'score-2', 0.7);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->listAll();

        foreach ($response['data'] as $score) {
            if ($score['name'] === 'score-1') {
                $this->assertNotEmpty($score['creator']);
                $this->assertSame('attribute-name-1', $score['attribute']);
                $this->assertSame(0.9, $score['value']);
            }

            if ($score['name'] === 'score-2') {
                $this->assertNotEmpty($score['creator']);
                $this->assertSame('attribute-name-2', $score['attribute']);
                $this->assertSame(0.7, $score['value']);
            }
        }
    }

    public function testCreateNew() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('attribute-test', 'score-test', 0.6);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('attribute-test', $response['data']['attribute']);
        $this->assertSame('score-test', $response['data']['name']);
        $this->assertSame(0.6, $response['data']['value']);
    }

    public function testCreateNewUtf8() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('áttribúte-test', 'scóre-tést', 0.3);

        $this->assertFalse($response['status']);
        $this->assertNotEmpty($response['error']);
    }

    public function testGetOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('attribute-test', 'score-test', 0.3);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->getOne('score-test');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('attribute-test', $response['data']['attribute']);
        $this->assertSame('score-test', $response['data']['name']);
        $this->assertSame(0.3, $response['data']['value']);
    }

    public function testUpdateOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('attribute-test', 'score-test', 0.3);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->updateOne('attribute-test', 'score-test', 0.4);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('attribute-test', $response['data']['attribute']);
        $this->assertSame('score-test', $response['data']['name']);
        $this->assertSame(0.4, $response['data']['value']);
    }

    public function testUpsertOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->deleteAll();

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('attribute-test', 'score-test', 0.3);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('attribute-test', $response['data']['attribute']);
        $this->assertSame('score-test', $response['data']['name']);
        $this->assertSame(0.3, $response['data']['value']);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->upsertOne('attribute-test', 'score-test', 0.5);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['creator']);
        $this->assertSame('attribute-test', $response['data']['attribute']);
        $this->assertSame('score-test', $response['data']['name']);
        $this->assertSame(0.5, $response['data']['value']);
    }

    public function testDeleteOne() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('attribute-test', 'score-test', 0.3);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->deleteOne('score-test');

        $this->assertTrue($response['status']);
    }

    public function testDeleteAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->deleteAll();

        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('attribute-test-1', 'score-test-1', 0.3);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('attribute-test-2', 'score-test-2', 0.4);
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->createNew('attribute-test-3', 'score-test-3', 0.5);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Scores->deleteAll();

        $this->assertTrue($response['status']);
        $this->assertSame(3, $response['deleted']);
    }
}
