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
 * Creates a new flag.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Flags->createNew('middle-name-mismatch', 'middle-name');

if ($response['status'] === true) {
    /**
     * Saves the id of the flag created
     */
    $flagSlug = $response['data']['slug'];

    /**
     * Lists all flags for the given username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->listAll();

    /**
     * Prints the api response.
     */
    foreach ($response['data'] as $flags) {
        print_r("\nID: " . $flags['id']);
        print_r("\nSlug: " . $flags['slug']);
        print_r("\nAttribute : " . $flags['attribute']);
        print_r("\n");
    }

    /**
     * Retrieves a process given its slug.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->getOne($flagSlug);

    /**
     * Prints the api response.
     */
    print_r("\nID: " . $flags['id']);
    print_r("\nSlug: " . $flags['slug']);
    print_r("\nAttribute : " . $flags['attribute']);
    print_r("\n");

    /**
     * Deletes one warning given its slug.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->deleteOne($flagSlug);

    /**
     * Prints the api response status.
     */
    print_r("\nStatus: " . $response['status']);

}

/**
 * Creates a new flag.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Flags->createNew('middle-name-mismatch', 'middle-name');

if ($response['status'] === true) {
    /**
     * Deletes all flags.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->deleteAll();

    /**
     * Prints the api response.
     */
    print_r("\nDeleteded flags: " . $response['deleted']);
    print_r("\n");
}
