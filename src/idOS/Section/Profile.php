<?php

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;

class Profile extends AbstractSection {
    /**
     * The profile userName.
     */
    private $userName;

    /**
     * Constructor Class.
     *
     * @param string        $userName
     * @param AuthInterface $authentication
     * @param Client        $client
     * @param bool|bool     $throwsExceptions
     */
    public function __construct(
        string $userName,
        AuthInterface $authentication,
        Client $client,
        bool $throwsExceptions = false
    ) {
        $this->userName = $userName;
        parent::__construct($authentication, $client, $throwsExceptions);
    }

    /**
     * returns the endpoint called passing the process id inside constructor.
     *
     * @param string $name
     *
     * @return endpoint instance
     */
    public function __get(string $name) : EndpointInterface {
        $className = $this->getEndpointClassName($name);

        return new $className(
            $this->userName,
            $this->authentication,
            $this->client
        );
    }

    /**
     * returns the endpoint called.
     *
     * @param string $name
     * @param array  $args
     *
     * @return endpoint instance
     */
    public function __call(string $name, array $args) : SectionInterface {
        $className = $this->getSectionClassName($name);
        $args[]    = $this->userName;
        $args[]    = $this->authentication;
        $args[]    = $this->client;

        return new $className(...$args);
    }
}
