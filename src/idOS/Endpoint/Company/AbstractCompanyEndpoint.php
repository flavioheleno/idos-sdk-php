<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace idOS\Endpoint\Company;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;
abstract class AbstractCompanyEndpoint extends AbstractEndpoint
{
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
    public function __construct($companySlug, AuthInterface $authentication, Client $client, $throwsExceptions = false, $baseUrl = 'https://api.idos.io/1.0/')
    {
        if (!is_string($companySlug)) {
            throw new \InvalidArgumentException("Argument \$companySlug passed to __construct() must be of the type string, " . (gettype($companySlug) == "object" ? get_class($companySlug) : gettype($companySlug)) . " given");
        }
        if (!is_bool($throwsExceptions)) {
            throw new \InvalidArgumentException("Argument \$throwsExceptions passed to __construct() must be of the type bool, " . (gettype($throwsExceptions) == "object" ? get_class($throwsExceptions) : gettype($throwsExceptions)) . " given");
        }
        if (!is_string($baseUrl)) {
            throw new \InvalidArgumentException("Argument \$baseUrl passed to __construct() must be of the type string, " . (gettype($baseUrl) == "object" ? get_class($baseUrl) : gettype($baseUrl)) . " given");
        }
        $this->companySlug = $companySlug;
        parent::__construct($authentication, $client, $throwsExceptions, $baseUrl);
    }
}