<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../settings.php';

/**
 * Creates an auth object for a CredentialToken required in the SDK constructor for calling all endpoints. Passing through the CredentialToken constructor: the credential public key, handler public key and handler private key, so the auth token can be generated.
 */
$auth = new \idOS\Auth\CredentialToken(
    $credentials['credentialPublicKey'],
    $credentials['handlerPublicKey'],
    $credentials['handlerPrivKey']
);

/**
 * Calls the create method that instantiates the SDK passing the auth object trought the constructor.
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Calling the Profile Endpoint passing the username, and after that, the Candidates Endpoint and the method listAll.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Candidates->listAll();

/**
 * Prints the response.
 */
print_r($response);

/**
 * Creates a new attribute candidate.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Candidates->createNew('attribute', 'value-test', 0.8);

/**
 * Prints the response.
 */
print_r($response);

/**
 * Retrieves the attribute candidate created.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Candidates->getOne('attribute');

/**
 * Prints the response.
 */
print_r($response);

/**
 * Deletes the attribute candidate created.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Candidates->deleteOne('attribute');

/**
 * Prints the response.
 */
print_r($response);

/**
 * Deletes all attribute candidates.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Candidates->deleteAll();

/**
 * Prints the response.
 */
print_r($response);
