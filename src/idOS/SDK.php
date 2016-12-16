<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace idOS;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;
use idOS\Section\SectionInterface;
class SDK
{
    /**
     * Authentication instance.
     *
     * @var \idOS\Auth\AuthInterface
     */
    private $authentication;
    /**
     * Guzzle Client instance.
     *
     * @var \GuzzleHttp\Client.
     */
    private $client;
    /**
     * Flag to convert errors to exceptions.
     *
     * @var bool
     */
    private $throwsExceptions;
    /**
     * idOS API base URL.
     *
     * @var string
     */
    private $baseUrl;
    /**
     * Creates the SDK instance.
     *
     * @param \idOS\Auth\AuthInterface $authentication
     * @param bool                     $throwsExceptions
     * @param string                   $baseUrl
     *
     * @return self instance
     */
    public static function create(AuthInterface $authentication, $throwsExceptions = false, $baseUrl = 'https://api.idos.io/1.0/')
    {
        if (!is_bool($throwsExceptions)) {
            throw new \InvalidArgumentException("Argument \$throwsExceptions passed to create() must be of the type bool, " . (gettype($throwsExceptions) == "object" ? get_class($throwsExceptions) : gettype($throwsExceptions)) . " given");
        }
        if (!is_string($baseUrl)) {
            throw new \InvalidArgumentException("Argument \$baseUrl passed to create() must be of the type string, " . (gettype($baseUrl) == "object" ? get_class($baseUrl) : gettype($baseUrl)) . " given");
        }
        $ret1585418936d8a2 = new static($authentication, new Client(), $throwsExceptions, $baseUrl);
        if (!$ret1585418936d8a2 instanceof self) {
            throw new \InvalidArgumentException("Argument returned must be of the type self, " . (gettype($ret1585418936d8a2) == "object" ? get_class($ret1585418936d8a2) : gettype($ret1585418936d8a2)) . " given");
        }
        return $ret1585418936d8a2;
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
        if (!is_bool($throwsExceptions)) {
            throw new \InvalidArgumentException("Argument \$throwsExceptions passed to __construct() must be of the type bool, " . (gettype($throwsExceptions) == "object" ? get_class($throwsExceptions) : gettype($throwsExceptions)) . " given");
        }
        if (!is_string($baseUrl)) {
            throw new \InvalidArgumentException("Argument \$baseUrl passed to __construct() must be of the type string, " . (gettype($baseUrl) == "object" ? get_class($baseUrl) : gettype($baseUrl)) . " given");
        }
        $this->authentication = $authentication;
        $this->client = $client;
        $this->throwsExceptions = $throwsExceptions;
        $this->setBaseUrl($baseUrl);
    }
    /**
     * Stores auth object.
     *
     * @param \idOS\Auth\AuthInterface $authentication
     *
     * @return self
     */
    public function setAuth(AuthInterface $authentication)
    {
        $this->authentication = $authentication;
        $ret1585418936e2ab = $this;
        if (!$ret1585418936e2ab instanceof self) {
            throw new \InvalidArgumentException("Argument returned must be of the type self, " . (gettype($ret1585418936e2ab) == "object" ? get_class($ret1585418936e2ab) : gettype($ret1585418936e2ab)) . " given");
        }
        return $ret1585418936e2ab;
    }
    /**
     * Returns auth object.
     *
     * @return \idOS\Auth\AuthInterface auth
     */
    public function getAuth()
    {
        $ret1585418936e484 = $this->authentication;
        if (!$ret1585418936e484 instanceof AuthInterface) {
            throw new \InvalidArgumentException("Argument returned must be of the type AuthInterface, " . (gettype($ret1585418936e484) == "object" ? get_class($ret1585418936e484) : gettype($ret1585418936e484)) . " given");
        }
        return $ret1585418936e484;
    }
    /**
     * Setter sets GuzzleHttp\Client instance.
     *
     * @param \GuzzleHttp\Client $client
     *
     * @return self
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
        $ret1585418936e664 = $this;
        if (!$ret1585418936e664 instanceof self) {
            throw new \InvalidArgumentException("Argument returned must be of the type self, " . (gettype($ret1585418936e664) == "object" ? get_class($ret1585418936e664) : gettype($ret1585418936e664)) . " given");
        }
        return $ret1585418936e664;
    }
    /**
     * Returns the GuzzleHttp\Client instance.
     *
     * @return \GuzzeHttp\Client client
     */
    public function getClient()
    {
        $ret1585418936e82b = $this->client;
        if (!$ret1585418936e82b instanceof Client) {
            throw new \InvalidArgumentException("Argument returned must be of the type Client, " . (gettype($ret1585418936e82b) == "object" ? get_class($ret1585418936e82b) : gettype($ret1585418936e82b)) . " given");
        }
        return $ret1585418936e82b;
    }
    /**
     * Sets the throws exception option.
     *
     * @param bool $throws
     *
     * @return self
     */
    public function setThrowsExceptions($throws)
    {
        if (!is_bool($throws)) {
            throw new \InvalidArgumentException("Argument \$throws passed to setThrowsExceptions() must be of the type bool, " . (gettype($throws) == "object" ? get_class($throws) : gettype($throws)) . " given");
        }
        $this->throwsExceptions = $throws;
        $ret1585418936ea1d = $this;
        if (!$ret1585418936ea1d instanceof self) {
            throw new \InvalidArgumentException("Argument returned must be of the type self, " . (gettype($ret1585418936ea1d) == "object" ? get_class($ret1585418936ea1d) : gettype($ret1585418936ea1d)) . " given");
        }
        return $ret1585418936ea1d;
    }
    /**
     * Returns boolean value of $throwsExceptions.
     *
     * @return bool throwsExceptions
     */
    public function getThrowsExceptions()
    {
        $ret1585418936ed43 = $this->throwsExceptions;
        if (!is_bool($ret1585418936ed43)) {
            throw new \InvalidArgumentException("Argument returned must be of the type bool, " . gettype($ret1585418936ed43) . " given");
        }
        return $ret1585418936ed43;
    }
    /**
     * Sets idOS API base URL.
     *
     * @param string $baseUrl
     *
     * @return self
     */
    public function setBaseUrl($baseUrl)
    {
        if (!is_string($baseUrl)) {
            throw new \InvalidArgumentException("Argument \$baseUrl passed to setBaseUrl() must be of the type string, " . (gettype($baseUrl) == "object" ? get_class($baseUrl) : gettype($baseUrl)) . " given");
        }
        $this->baseUrl = rtrim($baseUrl, '/') . '/';
        $ret1585418936eefa = $this;
        if (!$ret1585418936eefa instanceof self) {
            throw new \InvalidArgumentException("Argument returned must be of the type self, " . (gettype($ret1585418936eefa) == "object" ? get_class($ret1585418936eefa) : gettype($ret1585418936eefa)) . " given");
        }
        return $ret1585418936eefa;
    }
    /**
     * Returns idOS API base URL.
     *
     * @return string $baseUrl
     */
    public function getBaseUrl()
    {
        $ret1585418936f223 = $this->baseUrl;
        if (!is_string($ret1585418936f223)) {
            throw new \InvalidArgumentException("Argument returned must be of the type string, " . gettype($ret1585418936f223) . " given");
        }
        return $ret1585418936f223;
    }
    /**
     * Gets the ClassName and instantiates it.
     *
     * @param string $name
     *
     * @return \idOS\Endpoint\EndpointInterface
     */
    public function __get($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException("Argument \$name passed to __get() must be of the type string, " . (gettype($name) == "object" ? get_class($name) : gettype($name)) . " given");
        }
        $className = $this->getEndpointClassName($name);
        $ret1585418936f3eb = new $className($this->authentication, $this->client, $this->throwsExceptions, $this->baseUrl);
        if (!$ret1585418936f3eb instanceof EndpointInterface) {
            throw new \InvalidArgumentException("Argument returned must be of the type EndpointInterface, " . (gettype($ret1585418936f3eb) == "object" ? get_class($ret1585418936f3eb) : gettype($ret1585418936f3eb)) . " given");
        }
        return $ret1585418936f3eb;
    }
    /**
     * Returns the instance of endpoint given with params.
     *
     * @param string $name
     * @param array  $args
     *
     * @return \idOS\Section\SectionInterface
     */
    public function __call($name, array $args)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException("Argument \$name passed to __call() must be of the type string, " . (gettype($name) == "object" ? get_class($name) : gettype($name)) . " given");
        }
        $className = $this->getSectionClassName($name);
        $args[] = $this->authentication;
        $args[] = $this->client;
        $args[] = $this->throwsExceptions;
        $args[] = $this->baseUrl;
        $ret1585418936f777 = new $className(...$args);
        if (!$ret1585418936f777 instanceof SectionInterface) {
            throw new \InvalidArgumentException("Argument returned must be of the type SectionInterface, " . (gettype($ret1585418936f777) == "object" ? get_class($ret1585418936f777) : gettype($ret1585418936f777)) . " given");
        }
        return $ret1585418936f777;
    }
    /**
     * Returns the name of the endpoint class.
     *
     * @param string $name
     *
     * @return string className
     */
    protected function getEndpointClassName($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException("Argument \$name passed to getEndpointClassName() must be of the type string, " . (gettype($name) == "object" ? get_class($name) : gettype($name)) . " given");
        }
        $className = sprintf('%s\\%s\\%s', 'idOS', 'Endpoint', ucfirst($name));
        if (!class_exists($className)) {
            throw new \RuntimeException(sprintf('Invalid endpoint name "%s" (%s)', $name, $className));
        }
        $ret1585418936fb39 = $className;
        if (!is_string($ret1585418936fb39)) {
            throw new \InvalidArgumentException("Argument returned must be of the type string, " . gettype($ret1585418936fb39) . " given");
        }
        return $ret1585418936fb39;
    }
    /**
     * Returns the name of the section class.
     *
     * @param string $name
     *
     * @return string className
     */
    protected function getSectionClassName($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException("Argument \$name passed to getSectionClassName() must be of the type string, " . (gettype($name) == "object" ? get_class($name) : gettype($name)) . " given");
        }
        $className = sprintf('%s\\%s\\%s', 'idOS', 'Section', ucfirst($name));
        if (!class_exists($className)) {
            throw new \RuntimeException(sprintf('Invalid section name "%s" (%s)', $name, $className));
        }
        $ret1585418936fea6 = $className;
        if (!is_string($ret1585418936fea6)) {
            throw new \InvalidArgumentException("Argument returned must be of the type string, " . gettype($ret1585418936fea6) . " given");
        }
        return $ret1585418936fea6;
    }
}