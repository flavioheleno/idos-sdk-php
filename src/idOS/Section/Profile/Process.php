<?php

declare(strict_types = 1);

namespace idOS\Section\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;
use idOS\Section\AbstractSection;

class Process extends AbstractSection {
    /**
     * The process id necessary for all /process base endpoint.
     */
    private $processId;

    /**
     * Constructor Class.
     *
     * @param int                      $processId
     * @param string                   $userName
     * @param \idOS\Auth\AuthInterface $authentication
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
        $this->userName  = $userName;
        parent::__construct($authentication, $client, $throwsExceptions, $baseUrl);
    }

    /**
     * returns the endpoint called passing the process id inside constructor.
     *
     * @param string $name
     *
     * @return endpoint instance
     */
    public function __get(string $name) : EndpointInterface {
        return $this->createEndpoint(
            $name,
            [
                $this->processId,
                $this->userName
            ]
        );
    }
}
