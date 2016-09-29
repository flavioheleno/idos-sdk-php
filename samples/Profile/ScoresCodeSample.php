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
 * Calling the Profile Endpoint passing the username, and after that, the Scores Endpoint and the method listAll.
 *
 * @var [type]
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Scores->listAll();

/**
 * Prints the response.
 */
print_r($response);

/**
 * Creates a new score
 */
$response = $sdk
	->Profile($credentials['username'])
	->Scores->createNew('firstName', 'Jhon', 0.6);

/**
 * Prints the response
 */
print_r($response);

/**
 * Creates or updates a new score
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Scores->upsertOne('firstName', 'Jhon', 0.6);

/**
 * Prints the response
 */
print_r($response);

/**
 * Updates a score.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Scores->updateOne('firstName', 'Jhon', 0.7);

/**
 * Prints the response.
 */
print_r($response);

/**
 * Calls the get one method.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Scores->getOne('Jhon');

/**
 * Prints the response.
 */
print_r($response);

/**
 * Deletes the score created/updated.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Scores->deleteOne('Jhon');

/**
 * Prints the response.
 */
print_r($response);
