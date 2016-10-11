<?php

declare(strict_types = 1);

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

abstract class AbstractSection implements SectionInterface {
    /**
     * Authentication type (User, Credential, Identity).
     */
    protected $authentication;
    /**
     * GuzzeHTTP\Client;.
     */
    protected $client;
    /**
     * Boolean option to throw exception or not.
     *
     * @var [type]
     */
    protected $throwsExceptions;

    /**
     * Return the Endpoint Class Name.
     *
     * @param string $name
     *
     * @return string $className
     */
    protected function getEndpointClassName(string $name) : string {
        $className = sprintf(
            '%s\\%s',
            str_replace('Section', 'Endpoint', get_class($this)),
            ucfirst($name)
        );

        if (! class_exists($className)) {
            throw new \RuntimeException(
                sprintf(
                    'Invalid endpoint name "%s" (%s)',
                    $name,
                    $className
                )
            );
        }

        return $className;
    }

    /**
     * Returns the Section Class Name.
     *
     * @param string $name
     *
     * @return string $className
     */
    protected function getSectionClassName(string $name) : string {
        $className = sprintf(
            '%s\\%s',
            get_class($this),
            ucfirst($name)
        );

        if (! class_exists($className)) {
            throw new \RuntimeException(
                sprintf(
                    'Invalid section name "%s" (%s)',
                    $name,
                    $className
                )
            );
        }

        return $className;
    }

    /**
     * Constructor Class.
     *
     * @param AuthInterface $authentication
     * @param Client        $client
     * @param bool|bool     $throwExceptions
     */
    public function __construct(
        AuthInterface $authentication,
        Client $client,
        bool $throwExceptions = false
    ) {
        $this->authentication  = $authentication;
        $this->client          = $client;
        $this->throwExceptions = $throwExceptions;
    }
}
