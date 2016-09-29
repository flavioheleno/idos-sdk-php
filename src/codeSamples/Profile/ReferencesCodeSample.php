<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
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
 * Calls the create method that instantiates the SDK passing the auth object trought the constructor
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Calling the Profile Endpoint passing the username, and after that, the References Endpoint and the method listAll
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->References->listAll();

/**
 * Prints the response
 */
print_r($response);

/**
 * Creates a new reference
 */
$response = $sdk
	->Profile($credentials['username'])
	->References->createNew('reference', 'value');

/**
 * Prints the response
 */
print_r($response);

/**
 * Updates a reference
 */
$response = $sdk
	->Profile($credentials['username'])
	->References->updateOne('reference', 'new-value');

/**
 * Prints the response
 */
print_r($response);

/**
 * Retrieves the reference updated
 */
$response = $sdk
	->Profile($credentials['username'])
	->References->getOne('reference');

/**
 * Prints the response
 */
print_r($response);

/**
 * Deletes the reference created/updated
 */
$response = $sdk
	->Profile($credentials['username'])
	->References->deleteOne('reference');
/**
 * Prints the response
 */
print_r($response);

/**
 * Deletes all references
 */
$response = $sdk
	->Profile($credentials['username'])
	->References->deleteAll();

/**
 * Prints the response
 */
print_r($response);
