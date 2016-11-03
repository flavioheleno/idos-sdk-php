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
 * Creates or updates a gate.
 * The upsertOne method checks if the gate already exists on the database, if so, it updates it. Otherwise, it creates a new gate.
 * To create or update a gate is necessary to call the method upsertOne() passing as parameter the gate's name and the boolean pass value.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Gates->upsertOne('18+', true);

/**
 * Stores the gate slug of the slug created
 */
$gateSlug = $response['data']['slug'];

/**
 * Checks if the gate was created before calling other methods related to the gates endpoint that requires an existing gate.
 */
if ($response['status'] === true) {
    /**
     * Lists all gates related to the provided username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Gates->listAll();

    foreach ($response['data'] as $gate) {
        print_r($gate);
        echo PHP_EOL;
    }

    /**
     * Retrieves information of the gate related to the stored $gateSlug.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Gates->getOne($gateSlug);

    /**
     * Prints api call response to Gates endpoint
     */
    print_r($response['data']);
    echo PHP_EOL;

    /**
     * Deletes the gate related to the stored $gateSlug.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Gates->deleteOne($gateSlug);

    /**
     * Prints the status of the api call response to Features endpoint
     */
    print_r('Status: %s', $response['status']);
}

/**
 * Creates or updates a gate.
 * The upsertOne method checks if the gate already exists on the database, if so, it updates it. Otherwise, it creates a new gate.
 * To create or update a gate is necessary to call the method upsertOne() passing as parameter the gate's name and the boolean pass value.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Gates->upsertOne('18+', true);

/**
 * Checks if the gate was created/updated before calling other methods related to the gates endpoint that requires an existing gate.
 */
if ($response['status'] === true) {

    /**
     * Deletes all gates related to the username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Gates->deleteAll();

    /**
     * Prints the number of deleted candidates, information received from the api call response to Candidates endpoint
     */
    printf('Deleted gates: %s', $response['deleted']);
    echo PHP_EOL;
}
