<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

abstract class AbstractProfileEndpoint extends AbstractEndpoint
{
    /**
     * The username to be stored and used in all /profiles endpoints.
     *
     * @var string
     */
    protected $userName;
    /**
     * Constructor Class.
     *
     * @param string                   $userName         The user username
     * @param \idOS\Auth\AuthInterface $authentication   The type of the authentication: UserToken, HandlerToken and IdentityToken
     * @param \GuzzleHttp\Client       $client
     * @param bool                     $throwsExceptions
     * @param string                   $baseUrl
     *
     * @return void
     */
    public function __construct($userName, AuthInterface $authentication, Client $client, $throwsExceptions = false, $baseUrl = 'https://api.idos.io/1.0/')
    {
        if (! is_string($userName)) {
            throw new \InvalidArgumentException('Argument $userName passed to __construct() must be of the type string, ' . (gettype($userName) == 'object' ? get_class($userName) : gettype($userName)) . ' given');
        }
        if (! is_bool($throwsExceptions)) {
            throw new \InvalidArgumentException('Argument $throwsExceptions passed to __construct() must be of the type bool, ' . (gettype($throwsExceptions) == 'object' ? get_class($throwsExceptions) : gettype($throwsExceptions)) . ' given');
        }
        if (! is_string($baseUrl)) {
            throw new \InvalidArgumentException('Argument $baseUrl passed to __construct() must be of the type string, ' . (gettype($baseUrl) == 'object' ? get_class($baseUrl) : gettype($baseUrl)) . ' given');
        }
        $this->userName = $userName;
        parent::__construct($authentication, $client, $throwsExceptions, $baseUrl);
    }
}
