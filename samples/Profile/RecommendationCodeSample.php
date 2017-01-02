<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../settings.php';
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
 * Creates or Updates a new recommendation.
 * To create or update a new recommendation, it is necessary to call the createNew() method passing the result, the array containing all passed rules and the array containing all failed rules as parameter.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Recommendation->upsertOne("pass", [], []);

/**
 * Prints api call response to Recommmendation endpoint.
 */
print_r($response['data']);

/**
 * Retrieves information about the recommendation related to the user given.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Recommendation->getOne();

/**
 * Prints api call response to Recommendation endpoint
 */
print_r($response['data']);