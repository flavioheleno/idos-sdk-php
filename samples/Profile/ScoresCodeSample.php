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
 * Creates or updates a score.
 * The upsertOne method checks if the score already exists on the database, if so, it updates it. Otherwise, it creates a new score.
 * To create or update a score is necessary to call the method upsertOne() passing the attribute name, the score name and the score value as a parameter.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Scores->upsertOne('firstName', 'Jhon', 0.6);

/**
 * Checks if the score was created before calling other methods related to the scores endpoint (requires an existing score).
 */
if ($response['status'] === true) {
    /**
     * Lists all scores related to the provided username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Scores->listAll();

    /**
     * Prints api call response to Scores endpoint.
     */
    echo 'List All: ', PHP_EOL;
    foreach ($response['data'] as $score) {
        print_r($score);
        echo PHP_EOL;
    }

    /**
     * Updates the score created passing the attribute name of the score created, the new score name, and the new score value as a parameter.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Scores->updateOne('firstName', 'Jhon', 0.3);

    /**
     * Prints api call response to Scores endpoint.
     */
    echo 'Update one:', PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;

    /**
     * Retrieves information of the score created/updated given the score's name as parameter to the getOne method.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Scores->getOne('Jhon');

    /**
     * Prints api call response to Scores endpoint.
     */
    echo 'Get One:', PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;

    /**
     * Deletes the score created given the created score's name as a parameter to the deleteOne method.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Scores->deleteOne('Jhon');

    /**
     * Prints the status of the call response to Scores endpoint.
     */
    printf('Status: %s', $response['status']);
    echo PHP_EOL;
}

/**
 * To avoid the number of deleted scores equalling 0, the first thing is to create a new score, calling the createNew() method passing the attribute's name, the score's name and the score's value as a parameter.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Scores->createNew('firstName', 'Jhon', 0.6);

/**
 * Checks if the score was created before calling other methods related to the scores endpoint (requires an existing score).
 */
if ($response['status'] === true) {
    /**
     * Deletes all scores related to the provided username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Scores->deleteAll();

    /**
     * Prints the number of deleted scores.
     */
    printf('Deleted scores: %s', $response['deleted']);
    echo PHP_EOL;
}
