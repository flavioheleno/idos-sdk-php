<?php

declare(strict_types = 1);

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;

class Company extends AbstractSection {
    /**
     * The company slug.
     */
    private $companySlug;

    /**
     * Constructor Class.
     *
     * @param string                   $companySlug
     * @param \idOS\Auth\AuthInterface $authentication
     * @param \GuzzleHttp\Client       $client
     * @param bool                     $throwsExceptions
     * @param string                   $baseUrl
     *
     * @return void
     */
    public function __construct(
        string $companySlug,
        AuthInterface $authentication,
        Client $client,
        bool $throwsExceptions = false,
        string $baseUrl = 'https://api.idos.io/1.0/'
    ) {
        $this->companySlug = $companySlug;
        parent::__construct($authentication, $client, $throwsExceptions, $baseUrl);
    }

    /**
     * Return an endpoint instance properly initialized.
     *
     * @param string $name
     *
     * @return \idOS\Endpoint\EndpointInterface
     */
    public function __get(string $name) : EndpointInterface {
        return $this->createEndpoint($name, [$this->companySlug]);
    }

    /**
     * Return a section instance properly initialized.
     *
     * @param string $name
     * @param array  $args
     *
     * @return \idOS\Section\SectionInterface
     */
    public function __call(string $name, array $args) : SectionInterface {
        $args[] = $this->companySlug;
        return $this->createSection($name, $args);
    }
}
