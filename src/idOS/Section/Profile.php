<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;

class Profile extends AbstractSection
{
    /**
     * The profile userName.
     */
    private $userName;
    /**
     * Constructor Class.
     *
     * @param string                   $userName
     * @param \idOS\Auth\AuthInterface $authentication
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
    /**
     * Return an endpoint instance properly initialized.
     *
     * @param string $name
     *
     * @return \idOS\Endpoint\EndpointInterface
     */
    public function __get($name)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to __get() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $ret1585418939c690 = $this->createEndpoint($name, [$this->userName]);
        if (! $ret1585418939c690 instanceof EndpointInterface) {
            throw new \InvalidArgumentException('Argument returned must be of the type EndpointInterface, ' . (gettype($ret1585418939c690) == 'object' ? get_class($ret1585418939c690) : gettype($ret1585418939c690)) . ' given');
        }

        return $ret1585418939c690;
    }
    /**
     * Return a section instance properly initialized.
     *
     * @param string $name
     * @param array  $args
     *
     * @return \idOS\Section\SectionInterface
     */
    public function __call($name, array $args)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to __call() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $args[]            = $this->userName;
        $ret1585418939ca33 = $this->createSection($name, $args);
        if (! $ret1585418939ca33 instanceof SectionInterface) {
            throw new \InvalidArgumentException('Argument returned must be of the type SectionInterface, ' . (gettype($ret1585418939ca33) == 'object' ? get_class($ret1585418939ca33) : gettype($ret1585418939ca33)) . ' given');
        }

        return $ret1585418939ca33;
    }
}
