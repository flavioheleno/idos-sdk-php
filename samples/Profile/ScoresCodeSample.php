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
 * Creates or updates a new score.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Scores->upsertOne('firstName', 'Jhon', 0.6);


if ($response['status'] === true) {
    /**
     * Calling the Profile Endpoint passing the username, and after that, the Scores Endpoint and the method listAll.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Scores->listAll();

    /**
     * Prints the response.
     */
    foreach ($response['data'] as $score) {
        print_r("\nAttribute: " . $score['attribute']);
        print_r("\nName: " . $score['name']);
        print_r("\nValue: " . $score['value']);
        print_r("\n");
    }

    /**
     * Updates a score.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Scores->updateOne('firstName', 'Jhon', 0.3);

    /**
     * Prints the new value.
     */
    print_r("\nUpdated value: " . $response['data']['value']);
    print_r("\n");
    /**
     * Calls the get one method.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Scores->getOne('Jhon');

    /**
     * Prints the response.
     */
    print_r("\nAttribute: " . $response['data']['attribute']);
    print_r("\nName: " . $response['data']['name']);
    print_r("\nValue: " . $response['data']['value']);
    print_r("\n");

    /**
     * Deletes the score created/updated.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Scores->deleteOne('Jhon');

    /**
     * Prints the response status.
     */
    print_r("\nStatus: " . $response['status']);
    print_r("\n");
}

/**
 * Creates a new score.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Scores->createNew('firstName', 'Jhon', 0.6);


if ($response['status'] === true) {
    /**
     * Deletes all scores.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Scores->deleteAll();

    /**
     * Prints the number of deleted scores.
     */
    print_r("\nDeleted scores: " . $response['deleted']);
    print_r("\n");
}
