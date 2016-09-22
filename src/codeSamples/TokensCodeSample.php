<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/settings.php';

/**
 * Creates an auth object for a UserToken required in the SDK constructor for calling all endpoints. Passing through the UserToken constructor the credential public key, handler public and handler private key, so the auth token can be generated.
 */
$auth = new \idOS\Auth\UserToken(
	'f67b96dcf96b49d713a520ce9f54053c',
	$credentials['credentialPublicKey'],
	$credentials['credentialPrivKey']
);

/**
 * Calls the create method that instantiates the SDK passing the auth object trought the constructor
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Lists all processes
 */
$response = $sdk
	->Tokens
	->exchange('veridu-ltd');

/**
 * Prints the api response
 */
print_r($response);
