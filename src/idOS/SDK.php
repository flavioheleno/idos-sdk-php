<?php

namespace idOS;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Section\Profile;

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
}
