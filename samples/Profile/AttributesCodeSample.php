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
 * Calling the Profile Endpoint passing the username, and after that, the Attributes Endpoint and the method listAll.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Attributes->listAll();

/**
 * Prints the response.
 */
print_r($response);

/**
 * Creates a new reference.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Attributes->createNew('attribute', 'value-test', 1.2);

/**
 * Prints the response.
 */
print_r($response);

/**
 * Retrieves the attribute created
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Attributes->getOne('attribute');

/**
 * Prints the response.
 */
print_r($response);

/**
 * Deletes the attribute created.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Attributes->deleteOne('attribute');

/**
 * Prints the response
 */
print_r($response);

/**
 * Deletes all attributes.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Attributes->deleteAll();

/**
 * Prints the response.
 */
print_r($response);
