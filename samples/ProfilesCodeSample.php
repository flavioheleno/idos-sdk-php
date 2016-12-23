<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/settings.php';

/**
 * To instantiate the $sdk object, which is responsible for calling the endpoints, it is necessary to create the $auth object.
 * The $auth object can instantiate the CredentialToken class, IdentityToken class, UserToken class or None class. They relate to the type of authorization required by the endpoint.
 * Passing through the UserToken constructor: the username, credential public key and credencial private key, so the auth token can be generated.
 */
$auth = new \idOS\Auth\UserToken(
    $credentials['username'],
    $credentials['credentialPublicKey'],
    $credentials['credentialPrivKey']
);

/**
 * The correct way to call the endpoints is by statically calling the create method of the SDK class.
 * The static create method($auth) creates a new instance of the SDK class.
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Retrieves all information related to the user provided.
 */
$response = $sdk
    ->Profiles
    ->getOne($credentials['username']);

print_r($response['data']);
echo PHP_EOL;
