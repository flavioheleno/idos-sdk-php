<?php

declare(strict_types = 1);

namespace idOS\Endpoint\Profile\Process;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\Profile\AbstractProfileEndpoint;

abstract class AbstractProcessEndpoint extends AbstractProfileEndpoint {
    protected $processId;
    protected $userName;

    /**
     * Constructor Class.
     *
     * @param int                      $processId        The process' id
     * @param string                   $userName
     * @param \idOS\Auth\AuthInterface $authentication   The type of the authentication: UserToken, HandlerToken and IdentityToken
     * @param \GuzzleHttp\Client       $client
     * @param bool                     $throwsExceptions
     * @param string                   $baseUrl
     */
    public function __construct(
        int $processId,
        string $userName,
        AuthInterface $authentication,
        Client $client,
        bool $throwsExceptions = false,
        string $baseUrl = 'https://api.idos.io/1.0/'
    ) {
        $this->processId = $processId;
        parent::__construct($userName, $authentication, $client, $throwsExceptions, $baseUrl);
    }
}
