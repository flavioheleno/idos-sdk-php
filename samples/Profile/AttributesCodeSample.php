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
 * Creates candidates to be listed in the attributes endpoint.
 */
$sdk
    ->Profile($credentials['username'])
    ->Candidates->createNew('email', 'jhon@jhon.com', 0.9);
$sdk
    ->Profile($credentials['username'])
    ->Candidates->createNew('gender', 'male', 0.9);


/**
 * Creates and auth object for a UserToken required in the SDK constructor for calling all endpoints. Passing through the UserToken constructor: the username, credential public key and crecendial private key, so the auth token can be generated.
 */
$auth = new \idOS\Auth\UserToken(
	$credentials['username'],
    $credentials['credentialPublicKey'],
    $credentials['credentialPrivKey']
);

/**
 * Instantiating the SDK again, now passing the auth object related to the UserToken through the constructor.
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
print_r("Attributes:");

foreach ($response['data'] as $attribute) {
	print_r("\nName: " . $attribute['name']);
	print_r("\nValue: " . $attribute['value']);
	print_r("\n");
}

print_r("\n");
