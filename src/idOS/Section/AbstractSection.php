<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;

abstract class AbstractSection implements SectionInterface
{
    /**
     * Authentication type (User, Credential, Identity).
     *
     * @var \idOS\Auth\AuthInterface
     */
    protected $authentication;
    /**
     * GuzzeHTTP\Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /**
     * Boolean option to throw exception or not.
     *
     * @var bool
     */
    protected $throwsExceptions;
    /**
     * idOS API base URL.
     *
     * @var string
     */
    protected $baseUrl;
    /**
     * Return the Endpoint Class Name.
     *
     * @param string $name
     *
     * @return string $className
     */
    protected function getEndpointClassName($name)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to getEndpointClassName() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $className = sprintf('%s\\%s', str_replace('Section', 'Endpoint', get_class($this)), ucfirst($name));
        if (! class_exists($className)) {
            throw new \RuntimeException(sprintf('Invalid endpoint name "%s" (%s)', $name, $className));
        }
        $ret1585418939f383 = $className;
        if (! is_string($ret1585418939f383)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939f383) . ' given');
        }

        return $ret1585418939f383;
    }
    /**
     * Return an endpoint instance properly initialized.
     *
     * @param string $name
     * @param array  $args
     *
     * @return \idOS\Endpoint\EndpointInterface
     */
    protected function createEndpoint($name, array $args)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to createEndpoint() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $className = $this->getEndpointClassName($name);
        // aditional parameters
        $args[]            = $this->authentication;
        $args[]            = $this->client;
        $args[]            = $this->throwsExceptions;
        $args[]            = $this->baseUrl;
        $ret1585418939f788 = new $className(...$args);
        if (! $ret1585418939f788 instanceof EndpointInterface) {
            throw new \InvalidArgumentException('Argument returned must be of the type EndpointInterface, ' . (gettype($ret1585418939f788) == 'object' ? get_class($ret1585418939f788) : gettype($ret1585418939f788)) . ' given');
        }

        return $ret1585418939f788;
    }
    /**
     * Returns the Section Class Name.
     *
     * @param string $name
     *
     * @return string $className
     */
    protected function getSectionClassName($name)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to getSectionClassName() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $className = sprintf('%s\\%s', get_class($this), ucfirst($name));
        if (! class_exists($className)) {
            throw new \RuntimeException(sprintf('Invalid section name "%s" (%s)', $name, $className));
        }
        $ret1585418939fb91 = $className;
        if (! is_string($ret1585418939fb91)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939fb91) . ' given');
        }

        return $ret1585418939fb91;
    }
    /**
     * Return a section instance properly initialized.
     *
     * @param string $name
     * @param array  $args
     *
     * @return \idOS\Section\SectionInterface
     */
    protected function createSection($name, array $args)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to createSection() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $className = $this->getSectionClassName($name);
        // aditional parameters
        $args[]            = $this->authentication;
        $args[]            = $this->client;
        $args[]            = $this->throwsExceptions;
        $args[]            = $this->baseUrl;
        $ret1585418939fef9 = new $className(...$args);
        if (! $ret1585418939fef9 instanceof SectionInterface) {
            throw new \InvalidArgumentException('Argument returned must be of the type SectionInterface, ' . (gettype($ret1585418939fef9) == 'object' ? get_class($ret1585418939fef9) : gettype($ret1585418939fef9)) . ' given');
        }

        return $ret1585418939fef9;
    }
    /**
     * Constructor Class.
     *
     * @param \idOS\Auth\AuthInterface $authentication
     * @param \GuzzleHttp\Client       $client
     * @param bool                     $throwsExceptions
     * @param string                   $baseUrl
     *
     * @return void
     */
    public function __construct(AuthInterface $authentication, Client $client, $throwsExceptions = false, $baseUrl = 'https://api.idos.io/1.0/')
    {
        if (! is_bool($throwsExceptions)) {
            throw new \InvalidArgumentException('Argument $throwsExceptions passed to __construct() must be of the type bool, ' . (gettype($throwsExceptions) == 'object' ? get_class($throwsExceptions) : gettype($throwsExceptions)) . ' given');
        }
        if (! is_string($baseUrl)) {
            throw new \InvalidArgumentException('Argument $baseUrl passed to __construct() must be of the type string, ' . (gettype($baseUrl) == 'object' ? get_class($baseUrl) : gettype($baseUrl)) . ' given');
        }
        $this->authentication   = $authentication;
        $this->client           = $client;
        $this->throwsExceptions = $throwsExceptions;
        $this->baseUrl          = $baseUrl;
    }
}
