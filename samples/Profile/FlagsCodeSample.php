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
 * Creates a new flag.
 * To create a new flag is necessary to call the createNew() method passing as parameter the name of the flag and the attribute name.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Flags->createNew('middle-name-mismatch', 'middle-name');

/**
 * Checks if at least one flag was created before calling other methods related to the flags endpoint that requires an existing flag.
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
     * Prints api call response to Flags endpoint
     */
    echo 'List All: ', PHP_EOL;
    foreach ($response['data'] as $flags) {
        print_r($flags);
        echo PHP_EOL;
    }

    /**
     * Retrieves information about the flag created passing as parameter the stored $flagSlug.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->getOne($flagSlug);

    /**
     * Prints api call response to Flags endpoint
     */
    echo 'Get One: ', PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;

    /**
     * Deletes the flag retrieved passing as parameter the stored $flagSlug.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->deleteOne($flagSlug);

    /**
     * Prints the status of the call response to Flags endpoint
     */
    printf('Status: %s', $response['status']);
    echo PHP_EOL;

}

/**
 * To avoid the number of deleted flags to be equal to 0, the first thing is to create a new flag, calling the createNew() method passing as parameter the name of the flag and the attribute name.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Flags->createNew('middle-name-mismatch', 'middle-name');

/**
 * Checks if the flag was created before calling other methods related to the flags endpoint that requires an existing flag.
 */
if ($response['status'] === true) {
    /**
     * Deletes all flags related to the username provided.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Flags->deleteAll();

    /**
     * Prints the number of deleted flags retrieved from the call response to Flags endpoint
     */
    printf('Deleteded flags: %s', $response['deleted']);
    echo PHP_EOL;
}
