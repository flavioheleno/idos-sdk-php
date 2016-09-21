<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

abstract class AbstractProfileEndpoint extends AbstractEndpoint {
    protected $userName;

    /**
     * Constructor Class
     *
     * @param string        $userName         The user username
     * @param AuthInterface $authentication   The type of the authentication: UserToken, HandlerToken and IdentityToken
     * @param Client        $client
     * @param bool|boolean  $throwsExceptions
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
}
