<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../settings.php';

/**
 * To instantiate the $sdk object, which is responsible for calling the endpoints, it is necessary to create the $auth object.
 * The $auth object can instantiate the CredentialToken class, IdentityToken class, UserToken class or None class. They relate to the type of authorization required by the endpoint.
 * Passing through the CredentialToken constructor: the credential public key, handler public key and handler private key, so the auth token can be generated.
 */
$auth = new \idOS\Auth\CredentialToken(
    $credentials['credentialPublicKey'],
    $credentials['handlerPublicKey'],
    $credentials['handlerPrivKey']
);

/**
 * The correct way to call the endpoints is by statically calling the create method of the SDK class.
 * The static create method($auth) creates a new instance of the SDK class.
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Lists all processes related to the provided username.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Processes->listAll();

/**
 * Prints api call response to Processes endpoint.
 */
echo 'List All:', PHP_EOL;
foreach ($response['data'] as $process) {
    print_r($process);
    echo PHP_EOL;
}

/**
 * Stores the process id of the first index of the api call response.
 */
$processId = $response['data'][0]['id'];

/**
 * Retrieves information about the process related to the stored $processId.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Processes->getOne($processId);

/**
 * Prints api call response to Processes endpoint.
 */
echo 'Get One:', PHP_EOL;
print_r($response['data']);
echo PHP_EOL;
