<?php

namespace idOS;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Section\Profile;
use idOS\Section\Profile\Process;
use idOS\Endpoint;

class SDK {
    private $authentication;
    private $client;
    private $throwsExceptions;

    public static function create(AuthInterface $authentication) {
        return new static(
            $authentication,
            new Client()
        );
    }

    public function __construct(AuthInterface $authentication, Client $client, bool $throwsExceptions = false) {
        $this->authentication   = $authentication;
        $this->client           = $client;
        $this->throwsExceptions = $throwsExceptions;
    }

    public function setAuth(AuthInterface $authentication) : self {
        $this->authentication = $authentication;

        return $this;
    }

    public function getAuth() : AuthInterface {
        return $this->authentication;
    }

    public function setClient(Client $client) : self {
        $this->client = $client;

        return $this;
    }

    public function getClient() : Client {
        return $this->client;
    }

    public function setThrowsExceptions(bool $throws) : self {
        $this->throwsExceptions = $throws;

        return $this;
    }

    public function getThrowsExceptions() : bool {
        return $this->throwsExceptions;
    }

    public function profile(string $userName) : Profile {
        return new Profile(
            $userName,
            $this->authentication,
            $this->client,
            $this->throwsExceptions
        );
    }

    public function company(string $companySlug) : Company {
        return new Endpoint\Company(
            $companySlug,
            $this->authentication,
            $this->client,
            $this->throwsExceptions
        );
    }

    public function sso() : SSO {
        return new Endpoint\SSO(
            $this->authentication,
            $this->client,
            $this->throwsExceptions
        );
    }

    public function process(int $processId) : Process {
        return new Process(
            $processId,
            $this->authentication,
            $this->client,
            $this->throwsExceptions
        );
    }

     public function __get(string $name) {
        $className = $this->getEndpointClassName($name);

        return new $className(
            $this->authentication,
            $this->client
        );
    }

    public function __call(string $name, array $args) {
        $className = $this->getSectionClassName($name);
        $args[] = $this->authentication;
        $args[] = $this->client;

        return new $className(...$args);
    }

    protected function getEndpointClassName(string $name) : string {
        $className = sprintf(
            '%s\\%s\\%s',
            'idOS',
            'Endpoint',
            ucfirst($name)
        );

        if (! class_exists($className)) {
            throw new \RuntimeException(
                sprintf(
                    'Invalid endpoint name "%s" (%s)',
                    $name,
                    $className
                )
            );
        }

        return $className;
    }
}
