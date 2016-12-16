<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Exception\SDKError;
use idOS\Exception\SDKException;

abstract class AbstractEndpoint implements EndpointInterface
{
    /**
     * The Authentication type (UserToken, CredentialToken, IdentityToken).
     *
     * @var \idOS\Auth\AuthInterface
     */
    protected $authentication;
    /**
     * GuzzleHttp\Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /**
     * Boolean option to throw exception.
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
     * Sends the request to the api.
     *
     * @param string $method
     * @param array  $query
     * @param array  $body
     *
     * @return array response
     */
    private function sendRequest($method, $uri, array $query = [], array $body = [])
    {
        if (! is_string($method)) {
            throw new \InvalidArgumentException('Argument $method passed to sendRequest() must be of the type string, ' . (gettype($method) == 'object' ? get_class($method) : gettype($method)) . ' given');
        }
        if (! is_string($uri)) {
            throw new \InvalidArgumentException('Argument $uri passed to sendRequest() must be of the type string, ' . (gettype($uri) == 'object' ? get_class($uri) : gettype($uri)) . ' given');
        }
        $uri     = sprintf('%s%s', $this->baseUrl, ltrim($uri, '/'));
        $options = ['headers' => ['Authorization' => (string) $this->authentication], 'http_errors' => false];
        if (! empty($query)) {
            $options['query'] = $query;
        }
        if (! empty($body)) {
            $options['json'] = $body;
        }
        $response = $this->client->request($method, $uri, $options);
        $json     = json_decode((string) $response->getBody(), true);
        if ($json === null) {
            if ($this->throwsExceptions) {
                throw new SDKError();
            }
            $ret1585418938eb99 = [(string) $response->getBody()];
            if (! is_array($ret1585418938eb99)) {
                throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938eb99) . ' given');
            }

            return $ret1585418938eb99;
        }
        if ($json['status'] === false && $this->throwsExceptions) {
            throw new SDKException($json['error']['message'], $json['error']['type'], $json['error']['link']);
        }
        $ret1585418938ee35 = $json;
        if (! is_array($ret1585418938ee35)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938ee35) . ' given');
        }

        return $ret1585418938ee35;
    }
    /**
     * Sends GET request.
     *
     * @param string $uri
     * @param array  $query
     *
     * @return array response
     */
    protected function sendGet($uri, array $query = [])
    {
        if (! is_string($uri)) {
            throw new \InvalidArgumentException('Argument $uri passed to sendGet() must be of the type string, ' . (gettype($uri) == 'object' ? get_class($uri) : gettype($uri)) . ' given');
        }
        $ret1585418938f338 = $this->sendRequest('GET', $uri, $query, []);
        if (! is_array($ret1585418938f338)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938f338) . ' given');
        }

        return $ret1585418938f338;
    }
    /**
     * Sends a POST request.
     *
     * @param string $uri
     * @param array  $query
     * @param array  $body
     *
     * @return array response
     */
    protected function sendPost($uri, array $query = [], array $body = [])
    {
        if (! is_string($uri)) {
            throw new \InvalidArgumentException('Argument $uri passed to sendPost() must be of the type string, ' . (gettype($uri) == 'object' ? get_class($uri) : gettype($uri)) . ' given');
        }
        $ret1585418938f69b = $this->sendRequest('POST', $uri, $query, $body);
        if (! is_array($ret1585418938f69b)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938f69b) . ' given');
        }

        return $ret1585418938f69b;
    }
    /**
     * Sends a PATCH request.
     *
     * @param string $uri
     * @param array  $query
     * @param array  $body
     *
     * @return array response
     */
    protected function sendPatch($uri, array $query = [], array $body = [])
    {
        if (! is_string($uri)) {
            throw new \InvalidArgumentException('Argument $uri passed to sendPatch() must be of the type string, ' . (gettype($uri) == 'object' ? get_class($uri) : gettype($uri)) . ' given');
        }
        $ret1585418938f9f3 = $this->sendRequest('PATCH', $uri, $query, $body);
        if (! is_array($ret1585418938f9f3)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938f9f3) . ' given');
        }

        return $ret1585418938f9f3;
    }
    /**
     * Sends a PUT request.
     *
     * @param string $uri
     * @param array  $query
     * @param array  $body
     *
     * @return array response
     */
    protected function sendPut($uri, array $query = [], array $body = [])
    {
        if (! is_string($uri)) {
            throw new \InvalidArgumentException('Argument $uri passed to sendPut() must be of the type string, ' . (gettype($uri) == 'object' ? get_class($uri) : gettype($uri)) . ' given');
        }
        $ret1585418938fd2c = $this->sendRequest('PUT', $uri, $query, $body);
        if (! is_array($ret1585418938fd2c)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938fd2c) . ' given');
        }

        return $ret1585418938fd2c;
    }
    /**
     * Sends a DELETE request.
     *
     * @param string $uri
     * @param array  $query
     *
     * @return array response
     */
    protected function sendDelete($uri, array $query = [])
    {
        if (! is_string($uri)) {
            throw new \InvalidArgumentException('Argument $uri passed to sendDelete() must be of the type string, ' . (gettype($uri) == 'object' ? get_class($uri) : gettype($uri)) . ' given');
        }
        $ret1585418939003e = $this->sendRequest('DELETE', $uri, $query, []);
        if (! is_array($ret1585418939003e)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418939003e) . ' given');
        }

        return $ret1585418939003e;
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
