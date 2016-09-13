<?php

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

abstract class AbstractSection implements SectionInterface {
    protected $authentication;
    protected $client;
    protected $throwsExceptions;

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
