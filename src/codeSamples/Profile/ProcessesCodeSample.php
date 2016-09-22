<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../settings.php';

/**
 * Creates an auth object for a CredentialToken required in the SDK constructor for calling all endpoints. Passing through the CredentialToken constructor the credential public key, handler public and handler private key, so the auth token can be generated.
 */
$auth = new \idOS\Auth\CredentialToken(
	$credentials['credentialPublicKey'],
	$credentials['handlerPublicKey'],
	$credentials['handlerPrivKey']
);

/**
 * Valid username to be used in all /profiles endpoints.
 * @var string
 */
$username = 'usr001';

/**
 * Calls the create method that instantiates the SDK passing the auth object trought the constructor
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Lists all processes for the given username
 */
$response = $sdk
    ->Profile($username)
    ->Processes->listAll();

/**
 * Prints the api response
 */
print_r($response);

/**
 * Retrieves a process
 */
$response = $sdk
	->Profile($username)
	->Processes->getOne(1);

/**
 * Prints the api response
 */
print_r($response);

