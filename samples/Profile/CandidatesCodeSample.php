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
 * Creates a new candidate.
 */
$emailCandidate = $sdk
    ->Profile($credentials['username'])
    ->Candidates->createNew('email', 'jhon@jhon.com', 0.9);
/**
 * Creates a new candidate
 */
$genderCandidate = $sdk
    ->Profile($credentials['username'])
    ->Candidates->createNew('gender', 'male', 0.9);

if (($emailCandidate['status'] === true) || ($genderCandidate['status'] === true)) {
    /**
     * Calling the Profile Endpoint passing the username, and after that, the Candidates Endpoint and the method listAll.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Candidates->listAll();

    /**
     * Prints the response.
     */
    foreach ($response['data'] as $candidate) {
        print_r("\nAttribute: " . $candidate['attribute']);
        print_r("\nValue: " . $candidate['value']);
        print_r("\nSupport: " . $candidate['support']);
        print_r("\n");
    }
}

/**
 * Deletes all attribute candidates.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Candidates->deleteAll();

/**
 * Prints the number of deleted candidates.
 */
print_r("\nDeleted candidates: " . $response['deleted'] . "\n");
