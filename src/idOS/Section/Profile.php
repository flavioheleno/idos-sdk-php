<?php

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;

class Profile extends AbstractSection {
    private $userName;

    public function __construct(
        string $userName,
        AuthInterface $authentication,
        Client $client,
        bool $throwsExceptions = false
    ) {
        $this->userName       = $userName;
        parent::__construct($authentication, $client, $throwsExceptions);
    }

    public function __get(string $name) : EndpointInterface {
        $className = $this->getEndpointClassName($name);

        return new $className(
            $this->userName,
            $this->authentication,
            $this->client
        );
    }

    public function __call(string $name, array $args) : SectionInterface {
        $className = $this->getSectionClassName($name);
        $args[] = $this->userName;
        $args[] = $this->authentication;
        $args[] = $this->client;

        return new $className(...$args);
    }
}
