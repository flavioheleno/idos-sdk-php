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
 * Creates a new source.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Sources->createNew(
        'email',
        [
            'otp_check' => 'email'
        ]
    );

if ($response['status'] === true) {
    /**
     * Stores the source id of the source created
     */
    $sourceId = $response['data']['id'];

    /**
     * Lists all sources for the given username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Sources->listAll();

    /**
     * Prints the api response.
     */
    foreach ($response['data'] as $source) {
        print_r("\nID: " . $source['id']);
        print_r("\nName: " . $source['name']);
        print_r("\nTags: ");
        foreach ($source['tags'] as $tags) {
            print_r($tags . ";");
        }
        print_r("\n");
    }

    /**
     * Updates a source.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Sources->updateOne(
            $sourceId,
            [
                'test' => 'value-test',
                'other' => 'other-tag'
            ]
        );

    /**
     * Prints the api response.
     */
    print_r("\nID: " . $response['data']['id']);
    print_r("\nName: " . $response['data']['name']);
    print_r("\nTags: ");
    foreach ($response['data']['tags'] as $tags) {
        print_r($tags . "; ");
    }
    print_r("\n");

    /**
     * Retrieves a source given its id.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Sources->getOne($sourceId);

    /**
     * Prints the api response.
     */
    print_r("\nID: " . $response['data']['id']);
    print_r("\nName: " . $response['data']['name']);
    print_r("\nTags: ");
    foreach ($response['data']['tags'] as $tags) {
        print_r($tags . "; ");
    }
    print_r("\n");

    /**
     * Deletes the source created.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Sources->deleteOne($sourceId);

    /**
     * Prints the api response status.
     */
    print_r("\nStatus: " . $response['status']);
    print_r("\n");
}
