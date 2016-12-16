<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace idOS\Section\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;
use idOS\Section\AbstractSection;
class Process extends AbstractSection
{
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
    public function __construct($processId, $userName, AuthInterface $authentication, Client $client, $throwsExceptions = false, $baseUrl = 'https://api.idos.io/1.0/')
    {
        if (!is_int($processId)) {
            throw new \InvalidArgumentException("Argument \$processId passed to __construct() must be of the type int, " . (gettype($processId) == "object" ? get_class($processId) : gettype($processId)) . " given");
        }
        if (!is_string($userName)) {
            throw new \InvalidArgumentException("Argument \$userName passed to __construct() must be of the type string, " . (gettype($userName) == "object" ? get_class($userName) : gettype($userName)) . " given");
        }
        if (!is_bool($throwsExceptions)) {
            throw new \InvalidArgumentException("Argument \$throwsExceptions passed to __construct() must be of the type bool, " . (gettype($throwsExceptions) == "object" ? get_class($throwsExceptions) : gettype($throwsExceptions)) . " given");
        }
        if (!is_string($baseUrl)) {
            throw new \InvalidArgumentException("Argument \$baseUrl passed to __construct() must be of the type string, " . (gettype($baseUrl) == "object" ? get_class($baseUrl) : gettype($baseUrl)) . " given");
        }
        $this->processId = $processId;
        $this->userName = $userName;
        parent::__construct($authentication, $client, $throwsExceptions, $baseUrl);
    }
    /**
     * returns the endpoint called passing the process id inside constructor.
     *
     * @param string $name
     *
     * @return endpoint instance
     */
    public function __get($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException("Argument \$name passed to __get() must be of the type string, " . (gettype($name) == "object" ? get_class($name) : gettype($name)) . " given");
        }
        $ret1585418939de08 = $this->createEndpoint($name, [$this->processId, $this->userName]);
        if (!$ret1585418939de08 instanceof EndpointInterface) {
            throw new \InvalidArgumentException("Argument returned must be of the type EndpointInterface, " . (gettype($ret1585418939de08) == "object" ? get_class($ret1585418939de08) : gettype($ret1585418939de08)) . " given");
        }
        return $ret1585418939de08;
    }
}