<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../settings.php';

/**
 * For instantiating the $sdk object, responsible to call the endpoints, its necessary to create the $auth object.
 * The $auth object can instantiate the CredentialToken class, IdentityToken class, UserToken class or None class. They are related to the type of authorization required by the endpoint.
 * Passing through the CredentialToken constructor: the credential public key, handler public key and handler private key, so the auth token can be generated.
 */
$auth = new \idOS\Auth\CredentialToken(
    $credentials['credentialPublicKey'],
    $credentials['handlerPublicKey'],
    $credentials['handlerPrivKey']
);

/**
 * The proper way to call the endpoints is to statically calling the create method of the SDK class.
 * The static method create($auth) creates a new instance of the SDK class.
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Creates new candidates.
 * To create a new candidate, its necessary to call the function createNew() passing as parameter the attribute name, the value of the attribute and the support value.
 */
$emailCandidate = $sdk
    ->Profile($credentials['username'])
    ->Candidates->createNew('email', 'jhon@jhon.com', 0.9);

$genderCandidate = $sdk
    ->Profile($credentials['username'])
    ->Candidates->createNew('gender', 'male', 0.9);

/**
 * Checks if the candidates were created before calling other methods related to the candidates that requires an existing candidate.
 */
if (($emailCandidate['status'] === true) || ($genderCandidate['status'] === true)) {
    /**
     * Lists all candidates related to the username provided.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Candidates->listAll();

    /**
     * Prints api call response to Candidates endpoint
     */
    echo 'Listing all candidates:', PHP_EOL;
    foreach ($response['data'] as $candidate) {
        print_r($candidate);
        echo PHP_EOL;
    }
}

/**
 * Deletes all candidates related to the username provided.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Candidates->deleteAll();

/**
 * Prints the number of deleted candidates, information received from the api call response to Candidates endpoint
 */
printf('Deleted candidates: %s', $response['deleted']);
echo PHP_EOL;
