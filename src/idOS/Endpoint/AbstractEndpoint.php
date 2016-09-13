<?php

namespace idOS\Endpoint;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

abstract class AbstractEndpoint implements EndpointInterface {

    protected $authentication;
    protected $client;
    protected $throwExceptions;

    private function sendRequest(string $method, string $uri, array $query = [], array $body = []) : array {
        // $uri = sprintf('https://api.idos.io/1.0/%s', ltrim($uri, '/'));
        $uri = sprintf('http://localhost:8080/index.php/1.0/%s', ltrim($uri, '/'));

        $options = [
            'headers' => [
                'Authorization' => (string) $this->authentication
            ],
            'http_errors' => false
        ];

        if (! empty($query)) {
            $options['query'] = $query;
        }

        if (! empty($body)) {
            $options['json'] = $body;
        }

        $response = $this->client->request(
            $method,
            $uri,
            $options
        );

        $json = json_decode((string) $response->getBody(), true);
        if ($json === null) {
            if ($this->throwExceptions) {
                throw new SDKError();
            }

            return [(string) $response->getBody()];
        }

        if ((! $json['status']) && ($this->throwExceptions)) {
            throw new SDKException(
                $json['error']['message'],
                $json['error']['type'],
                $json['error']['link']
            );
        }

        return $json;
    }

    protected function sendGet(string $uri, array $query = []) : array {
        return $this->sendRequest(
            'GET',
            $uri,
            $query,
            []
        );
    }

    protected function sendPost(string $uri, array $query = [], array $body = []) : array {
        return $this->sendRequest(
            'POST',
            $uri,
            $query,
            $body
        );
    }

    protected function sendPatch(string $uri, array $query = [], array $body = []) : array {
        return $this->sendRequest(
            'PATCH',
            $uri,
            $query,
            $body
        );
    }

    protected function sendPut(string $uri, array $query = [], array $body = []) : array {
        return $this->sendRequest(
            'PUT',
            $uri,
            $query,
            $body
        );
    }

    protected function sendDelete(string $uri, array $query = []) : array {
        return $this->sendRequest(
            'DELETE',
            $uri,
            $query,
            []
        );
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
