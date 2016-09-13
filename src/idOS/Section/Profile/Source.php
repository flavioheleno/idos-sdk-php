<?php

namespace idOS\Section\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;
use idOS\Section\AbstractSection;
use idOS\Section\SectionInterface;

class Source extends AbstractSection {
    private $sourceId;

    public function __construct(
        int $sourceId,
        string $userName,
        AuthInterface $authentication,
        Client $client,
        bool $throwsExceptions = false
    ) {
        $this->sourceId = $sourceId;
        $this->userName = $userName;
        parent::__construct($authentication, $client, $throwsExceptions);
    }

    public function __get(string $name) : EndpointInterface {
        $className = $this->getEndpointClassName($name);

        return new $className(
            $this->sourceId,
            $this->userName,
            $this->authentication,
            $this->client
        );
    }

    public function __call(string $name, array $args) : SectionInterface {
        $className = $this->getSectionClassName($name);
        $args[] = $this->sourceId;
        $args[] = $this->userName;
        $args[] = $this->authentication;
        $args[] = $this->client;

        return new $className(...$args);
    }
}
