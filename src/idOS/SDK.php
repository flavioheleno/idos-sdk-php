<?php

declare(strict_types = 1);

namespace idOS;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;
use idOS\Section\SectionInterface;

class SDK {
    /**
     * Authentication instance.
     *
     * @var \idOS\Auth\AuthInterface
     */
    private $authentication;
    /**
     * Guzzle Client instance.
     *
     * @var \GuzzleHttp\Client.
     */
    private $client;
    /**
     * Flag to convert errors to exceptions.
     *
     * @var bool
     */
    private $throwsExceptions;
    /**
     * idOS API base URL.
     *
     * @var string
     */
    private $baseUrl;

    /**
     * Creates the SDK instance.
     *
     * @param AuthInterface $authentication
     *
     * @return self instance
     */
    public static function create(
        AuthInterface $authentication,
        bool $throwsExceptions = false,
        string $baseUrl = 'https://api.idos.io/1.0/'
    ) : self {
        return new static(
            $authentication,
            new Client(),
            $throwsExceptions,
            $baseUrl
        );
    }

    /**
     * Constructor Class.
     *
     * @param AuthInterface $authentication
     * @param Client        $client
     * @param bool          $throwsExceptions
     *
     * @return void
     */
    public function __construct(
        AuthInterface $authentication,
        Client $client,
        bool $throwsExceptions = false,
        string $baseUrl = 'https://api.idos.io/1.0/'
    ) {
        $this->authentication   = $authentication;
        $this->client           = $client;
        $this->throwsExceptions = $throwsExceptions;
        $this->setBaseUrl($baseUrl);
    }

    /**
     * Stores auth object.
     *
     * @param \idOS\Auth\AuthInterface $authentication
     *
     * @return self
     */
    public function setAuth(AuthInterface $authentication) : self {
        $this->authentication = $authentication;

        return $this;
    }

    /**
     * Returns auth object.
     *
     * @return \idOS\Auth\AuthInterface auth
     */
    public function getAuth() : AuthInterface {
        return $this->authentication;
    }

    /**
     * Setter sets GuzzleHttp\Client instance.
     *
     * @param \GuzzleHttp\Client $client
     *
     * @return self
     */
    public function setClient(Client $client) : self {
        $this->client = $client;

        return $this;
    }

    /**
     * Returns the GuzzleHttp\Client instance.
     *
     * @return \GuzzeHttp\Client client
     */
    public function getClient() : Client {
        return $this->client;
    }

    /**
     * Sets the throws exception option.
     *
     * @param bool $throws
     *
     * @return self
     */
    public function setThrowsExceptions(bool $throws) : self {
        $this->throwsExceptions = $throws;

        return $this;
    }

    /**
     * Returns boolean value of $throwsExceptions.
     *
     * @return bool throwsExceptions
     */
    public function getThrowsExceptions() : bool {
        return $this->throwsExceptions;
    }

    /**
     * Sets idOS API base URL.
     *
     * @param string $baseUrl
     *
     * @return self
     */
    public function setBaseUrl(string $baseUrl) : self {
        $this->baseUrl = rtrim($baseUrl, '/') . '/';

        return $this;
    }

    /**
     * Returns idOS API base URL.
     *
     * @return string $baseUrl
     */
    public function getBaseUrl() : string {
        return $this->baseUrl;
    }

    /**
     * Gets the ClassName and instantiates it.
     *
     * @param string $name
     *
     * @return \idOS\Endpoint\EndpointInterface
     */
    public function __get(string $name) {
        $className = $this->getEndpointClassName($name);

        return new $className(
            $this->authentication,
            $this->client,
            $this->throwsExceptions,
            $this->baseUrl
        );
    }

    /**
     * Returns the instance of endpoint given with params.
     *
     * @param string $name
     * @param array  $args
     *
     * @return \idOS\Section\SectionInterface
     */
    public function __call(string $name, array $args) {
        $className = $this->getSectionClassName($name);
        $args[]    = $this->authentication;
        $args[]    = $this->client;
        $args[]    = $this->throwsExceptions;
        $args[]    = $this->baseUrl;

        return new $className(...$args);
    }

    /**
     * Returns the name of the endpoint class.
     *
     * @param string $name
     *
     * @return string className
     */
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

    /**
     * Returns the name of the section class.
     *
     * @param string $name
     *
     * @return string className
     */
    protected function getSectionClassName(string $name) : string {
        $className = sprintf(
            '%s\\%s\\%s',
            'idOS',
            'Section',
            ucfirst($name)
        );

        if (! class_exists($className)) {
            throw new \RuntimeException(
                sprintf(
                    'Invalid section name "%s" (%s)',
                    $name,
                    $className
                )
            );
        }

        return $className;
    }
}
