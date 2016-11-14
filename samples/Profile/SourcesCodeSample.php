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
 * Creates a new source.
 * To create a new source, it is necessary to call the createNew() method passing the source name, and the tags array containing the tags and its values as a parameter.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Sources->createNew(
        'email',
        [
            'otp_check' => 'email'
        ]
    );

/**
 * Checks if at least one source was created before calling other methods related to the sources endpoint (requires an existing source).
 */
if ($response['status'] === true) {
    /**
     * Stores the source id of the source created.
     */
    $sourceId = $response['data']['id'];

    /**
     * Lists all sources related to the provided username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Sources->listAll();

    /**
     * Prints api call response to Sources endpoint.
     */
    echo 'List All:', PHP_EOL;
    foreach ($response['data'] as $source) {
        print_r($source);
        echo PHP_EOL;
    }

    /**
     * Updates the source created passing the stored $sourceId and the tags array containing the tags and its values as a parameter.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Sources->updateOne(
            $sourceId,
            [
                'test'  => 'value-test',
                'other' => 'other-tag'
            ]
        );

    /**
     * Prints the api response.
     */
    echo 'Update One:', PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;

    /**
     * Retrieves information of the source created given the stored $sourceId.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Sources->getOne($sourceId);

    /**
     * Prints api call response to Sources endpoint.
     */
    echo 'Get One:', PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;

    /**
     * Deletes the source retrieved passing the stored $sourceId as a parameter.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Sources->deleteOne($sourceId);

    /**
     * Prints the status of the call response to Flags endpoint.
     */
    printf('Status: %s', $response['status']);
    echo PHP_EOL;
}
