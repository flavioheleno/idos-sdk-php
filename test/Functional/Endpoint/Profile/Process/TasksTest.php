<?php

namespace Test\Functional\Endpoint\Profile\Process;

use Test\Functional\AbstractFunctional;

class TasksTest extends AbstractFunctional {
    private $processId;

    protected function setUp() {
        parent::setUp();

        $processes = $this->sdk
            ->Profile($this->credentials['username'])
            ->Processes->listAll();

        $this->processId = $processes['data'][0]['id'];
    }

    public function testListAll() {
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Process($this->processId)
            ->Tasks->createNew('name-test-1', 'event-test-1', true, false, 'message-test-1');
        $this->sdk
            ->Profile($this->credentials['username'])
            ->Process($this->processId)
            ->Tasks->createNew('name-test-2', 'event-test-2', false, true, 'message-test-2');

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Process($this->processId)
            ->Tasks->listAll();

        foreach ($response['data'] as $task) {
            if ($task['name'] === 'name-test-1') {
                $this->assertSame('event-test-1', $task['event']);
                $this->assertTrue($task['running']);
                $this->assertFalse($task['success']);
            }

            if ($task['name'] === 'name-test-2') {
                $this->assertSame('event-test-2', $task['event']);
                $this->assertFalse($task['running']);
                $this->assertTrue($task['success']);
            }
        }
    }

    public function testCreateNew() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Process($this->processId)
            ->Tasks->createNew('name-test', 'event-test', true, false, 'message-test');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('event-test', $response['data']['event']);
        $this->assertTrue($response['data']['running']);
        $this->assertFalse($response['data']['success']);
    }

    public function testCreateNewUtf8() {
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Process($this->processId)
            ->Tasks->createNew('náme-tést', 'event-test', true, false, 'message-test');

        $this->assertFalse($response['status']);
        $this->assertNotEmpty($response['error']);
    }

    public function testGetOne() {
        $task = $this->sdk
            ->Profile($this->credentials['username'])
            ->Process($this->processId)
            ->Tasks->createNew('name-test', 'event-test', true, false, 'message-test');

        $response = $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Process($this->processId)
            ->Tasks->getOne($task['data']['id']);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('event-test', $response['data']['event']);
        $this->assertTrue($response['data']['running']);
        $this->assertFalse($response['data']['success']);
    }

    public function testUpdateOne() {
        $task = $this->sdk
            ->Profile($this->credentials['username'])
            ->Process($this->processId)
            ->Tasks->createNew('name-test', 'event-test', true, false, 'message-test');

        $response = $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Process($this->processId)
            ->Tasks->updateOne($task['data']['id'], 'name-test-changed', 'event-test-changed', false, true, 'message-test-changed');

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame('event-test', $response['data']['event']);
        $this->assertFalse($response['data']['running']);
        $this->assertTrue($response['data']['success']);
    }
}
