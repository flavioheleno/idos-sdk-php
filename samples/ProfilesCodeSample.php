<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/settings.php';

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
 * Lists all profiles related to the credentials provided.
 */
$response = $sdk
    ->Profiles
    ->listAll();

/**
 * Prints all usernames provided by the api call response to Profiles endpoint.
 */
echo 'Usernames:', PHP_EOL;
foreach ($response['data'] as $profiles) {
    printf($profiles['username']);
    echo PHP_EOL;
}
