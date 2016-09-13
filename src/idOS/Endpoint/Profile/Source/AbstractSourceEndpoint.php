<?php

namespace idOS\Endpoint\Profile\Source;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\Profile\AbstractProfileEndpoint;

abstract class AbstractSourceEndpoint extends AbstractProfileEndpoint {
    protected $sourceId;

    public function __construct(
        int $sourceId,
        string $userName,
        AuthInterface $authentication,
        Client $client,
        bool $throwsExceptions = false
    ) {
        $this->sourceId = $sourceId;
        parent::__construct($userName, $authentication, $client, $throwsExceptions);
    }
}
