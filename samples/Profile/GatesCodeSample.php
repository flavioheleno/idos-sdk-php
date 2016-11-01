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
 * Calls the create method that instantiates the SDK passing the auth object throught the constructor.
 */
$sdk = \idOS\SDK::create($auth, true);

/**
 * Creates a new gate or updates it.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Gates->upsertOne('18+', true);

if ($response['status'] === true) {
    /**
     * Saves the gate slug
     */
    $gateSlug = $response['data']['slug'];

    /**
     * Lists all gates for the given username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Gates->listAll();

    foreach ($response['data'] as $gate) {
        print_r("\nID: " . $gate['id']);
        print_r("\nName: " . $gate['name']);
        print_r("\nSlug: " . $gate['slug']);
        print_r("\nPass: " . $gate['pass']);
        print_r("\nReview: " . $gate['review']);
        print_r("\n");
    }


    /**
     * Retrieves the gate created.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Gates->getOne($gateSlug);

    /**
     * Prints the info about the gate related to the gateSlug
     */
    print_r("\nID: " . $gate['id']);
    print_r("\nName: " . $gate['name']);
    print_r("\nSlug: " . $gate['slug']);
    print_r("\nPass: " . $gate['pass']);
    print_r("\nReview: " . $gate['review']);

    /**
     * Deletes the gate created and updated.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Gates->deleteOne($gateSlug);

    /**
     * Prints the api response.
     */
    print_r("\nStatus : " . $response['status']);
}

/**
 * Creates a new gate or updates it.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Gates->upsertOne('18+', true);

if ($response['status'] === true) {

    /**
     * Deletes all gates.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Gates->deleteAll();

    /**
     * Prints the api response.
     */
    print_r("\nDeleted gates: " . $response['deleted']);
    print_r("\n");
}
