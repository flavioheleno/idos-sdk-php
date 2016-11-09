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
 * Creates a new reference.
 * To create a new reference is necessary to call the createNew() method passing as parameter the reference name and the reference value.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->References->createNew('reference', 'value');

/**
 * Checks if the reference was created before calling other methods related to the references that requires an existing reference.
 */
if ($response['status'] === true) {

    /**
     * Lists all references related to the provided username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->References->listAll();

    /**
     * Prints api call response to References endpoint
     */
    echo 'List All:', PHP_EOL;
    foreach ($response['data'] as $reference) {
        print_r($reference);
        echo PHP_EOL;
    }

    /**
     * Updates the created reference passing as parameter the reference's name and the new reference value.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->References->updateOne('reference', 'new-value');

    /**
     * Prints api call response to References endpoint.
     */
    echo 'Update One:' , PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;

    /**
     * Retrieves information of the reference updated given the reference name.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->References->getOne('reference');

    /**
     * Prints api call response to References endpoint.
     */
    echo 'Get One :', PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;

    /**
     * Deletes the reference given the reference name.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->References->deleteOne($response['data']['name']);

    /**
     * Prints the status of the call response to References endpoint
     */
    printf('Status: %s', $response['status']);
    echo PHP_EOL;
}

/**
 * To avoid the number of deleted references to be equal to 0, the first thing is to create a new reference, calling the createNew() method passing as parameter the the reference's name and the reference's value;
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->References->createNew('reference', 'value');

/**
 * Checks if the reference was created before calling other methods related to the references that requires an existing reference.
 */
if ($response['status'] === true) {
    /**
     * Deletes all references related to the provided username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->References->deleteAll();

    /**
     * Prints the number of deleted references.
     */
    printf('Deleted references: %d', $response['deleted']);
    echo PHP_EOL;
}
