<?php

declare(strict_types = 1);

namespace idOS\Endpoint\Company;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

abstract class AbstractCompanyEndpoint extends AbstractEndpoint {
    /**
     * The company slug to be stored and used in all /companies endpoints.
     *
     * @var string
     */
    protected $companySlug;

    /**
     * Constructor Class.
     *
     * @param string                   $companySlug      The company's slug
     * @param \idOS\Auth\AuthInterface $authentication   The type of the authentication: UserToken, HandlerToken and IdentityToken
     * @param \GuzzleHttp\Client       $client
     * @param bool                     $throwsExceptions
     * @param string                   $baseUrl
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
}
