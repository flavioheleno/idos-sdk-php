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
 * Creates a new reference.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->References->createNew('reference', 'value');

if ($response['status'] === true) {

    /**
     * Calling the Profile Endpoint passing the username, and after that, the References Endpoint and the method listAll.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->References->listAll();

    /**
     * Prints the response.
     */
    foreach ($response['data'] as $reference) {
        print_r("\nName: " . $reference['name']);
        print_r("\nValue: " . $reference['value']);
        print_r("\n");
    }

    /**
     * Updates a reference.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->References->updateOne('reference', 'new-value');

    /**
     * Prints the response.
     */
    print_r("\nName: " . $response['data']['name']);
    print_r("\nValue: " . $response['data']['value']);
    print_r("\n");

    /**
     * Retrieves the reference updated.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->References->getOne($response['data']['name']);

    /**
     * Prints the response.
     */
    print_r("\nName: " . $response['data']['name']);
    print_r("\nValue: " . $response['data']['value']);
    print_r("\n");
    /**
     * Deletes the reference created/updated.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->References->deleteOne($response['data']['name']);
    /**
     * Prints the response status.
     */
    print_r("\nStatus: " . $response['status']);
    print_r("\n");
}

/**
 * Creates a new reference.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->References->createNew('reference', 'value');

if ($response['status'] === true) {
    /**
     * Deletes all references.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->References->deleteAll();

    /**
     * Prints the number of deleted references.
     */
    print_r("\nDeleted references: " . $response['deleted']);
    print_r("\n");
}
