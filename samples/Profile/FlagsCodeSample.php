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
 * Creates a new flag.
 * To create a new flag it is necessary to call the createNew() method passing the name of the flag and the attribute name as a parameter.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Flags->createNew('middle-name-mismatch', 'middle-name');

/**
 * Checks if at least one flag was created before calling other methods related to the flags endpoint (requires an existing flag).
 */
if ($response['status'] === true) {
    /**
     * Stores the flag slug of the 'middle-name-mismatch' flag created.
     */
    $flagSlug = $response['data']['slug'];

    /**
     * Lists all flags for the given username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->listAll();

    /**
     * Prints api call response to Flags endpoint.
     */
    echo 'List All: ', PHP_EOL;
    foreach ($response['data'] as $flags) {
        print_r($flags);
        echo PHP_EOL;
    }

    /**
     * Retrieves information about the flag created passing the stored $flagSlug as  aparameter.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->getOne($flagSlug);

    /**
     * Prints api call response to Flags endpoint.
     */
    echo 'Get One: ', PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;

    /**
     * Deletes the flag retrieved passing the stored $flagSlug as a parameter.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->deleteOne($flagSlug);

    /**
     * Prints the status of the call response to Flags endpoint.
     */
    printf('Status: %s', $response['status']);
    echo PHP_EOL;
}

/**
 * To avoid the number of deleted flags to be equal to 0, the first thing is to create a new flag, calling the createNew() method passing the name of the flag and the attribute name as a parameter.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Flags->createNew('middle-name-mismatch', 'middle-name');

/**
 * Checks if the flag was created before calling other methods related to the flags endpoint (requires an existing flag).
 */
if ($response['status'] === true) {
    /**
     * Deletes all flags related to the username provided.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->deleteAll();

    /**
     * Prints the number of deleted flags retrieved from the call response to Flags endpoint.
     */
    printf('Deleteded flags: %s', $response['deleted']);
    echo PHP_EOL;
}
