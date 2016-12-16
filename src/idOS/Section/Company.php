<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;

class Company extends AbstractSection
{
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
    public function __construct($companySlug, AuthInterface $authentication, Client $client, $throwsExceptions = false, $baseUrl = 'https://api.idos.io/1.0/')
    {
        if (! is_string($companySlug)) {
            throw new \InvalidArgumentException('Argument $companySlug passed to __construct() must be of the type string, ' . (gettype($companySlug) == 'object' ? get_class($companySlug) : gettype($companySlug)) . ' given');
        }
        if (! is_bool($throwsExceptions)) {
            throw new \InvalidArgumentException('Argument $throwsExceptions passed to __construct() must be of the type bool, ' . (gettype($throwsExceptions) == 'object' ? get_class($throwsExceptions) : gettype($throwsExceptions)) . ' given');
        }
        if (! is_string($baseUrl)) {
            throw new \InvalidArgumentException('Argument $baseUrl passed to __construct() must be of the type string, ' . (gettype($baseUrl) == 'object' ? get_class($baseUrl) : gettype($baseUrl)) . ' given');
        }
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
    public function __get($name)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to __get() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $ret158541893a14de = $this->createEndpoint($name, [$this->companySlug]);
        if (! $ret158541893a14de instanceof EndpointInterface) {
            throw new \InvalidArgumentException('Argument returned must be of the type EndpointInterface, ' . (gettype($ret158541893a14de) == 'object' ? get_class($ret158541893a14de) : gettype($ret158541893a14de)) . ' given');
        }

        return $ret158541893a14de;
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
        $args[]            = $this->companySlug;
        $ret158541893a1b6b = $this->createSection($name, $args);
        if (! $ret158541893a1b6b instanceof SectionInterface) {
            throw new \InvalidArgumentException('Argument returned must be of the type SectionInterface, ' . (gettype($ret158541893a1b6b) == 'object' ? get_class($ret158541893a1b6b) : gettype($ret158541893a1b6b)) . ' given');
        }

        return $ret158541893a1b6b;
    }
}
