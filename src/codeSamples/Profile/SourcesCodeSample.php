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
$username = 'f67b96dcf96b49d713a520ce9f54053c';

/**
 * Calls the create method that instantiates the SDK passing the auth object trought the constructor
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Lists all sources for the given username
 */
$response = $sdk
    ->Profile($username)
    ->Sources->listAll();

/**
 * Prints the api response
 */
print_r($response);

/**
 * Gets the first sourceId
 */
$sourceId = $response['data'][0]['id'];

/**
 * Retrieves a process given its slug
 */
$response = $sdk
	->Profile($username)
	->Sources->getOne($sourceId);

/**
 * Prints the api response
 */
print_r($response);

