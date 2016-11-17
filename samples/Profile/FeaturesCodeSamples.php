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
 * To create a new feature, it is necessary to provide the sourceId where the feature to be created is related to this id.
 * In this example, all sources are deleted to avoid creating a repeated source.
 */
$sdk
    ->Profile($credentials['username'])
    ->Sources->deleteAll();

/**
 * Creates a new source to be used in the feature endpoint.
 */
$source = $sdk
    ->Profile($credentials['username'])
    ->Sources->createNew('name-test', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);

/**
 * Stores the source id of the created source.
 */
$sourceId = $source['data']['id'];

/**
 * Deletes all features related to the username provided to avoid creating a repeated feature.
 */
$sdk
    ->Profile($credentials['username'])
    ->Features->deleteAll();

/**
 * Creates new features.
 * To create a new feature, it is necessary to call the createNew() method passing the source id, the feature name, the feature value and the type of the feature value as a parameter.
 */
$featureSample1 = $sdk
    ->Profile($credentials['username'])
    ->Features->createNew($sourceId, 'name-test-1', 'value-test-1', 'string');

$featureSample2 = $sdk
    ->Profile($credentials['username'])
    ->Features->createNew($sourceId, 'name-test-2', 3, 'integer');

/**
 * Stores the feature id of the featureSample1 feature created.
 */
$featureId = $featureSample1['data']['id'];

/**
 * Checks if at least one feature was created before calling other methods related to the features endpoint (requires an existing feature).
 */
if (($featureSample1['status'] === true) || ($featureSample2['status'] === true)) {
    /**
     * Lists all features related to the username provided.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Features->listAll();

    /**
     * Prints api call response to Features endpoint.
     */
    echo 'Listing all features: ', PHP_EOL;
    foreach ($response['data'] as $feature) {
        print_r($feature);
        echo PHP_EOL;
    }

    /**
     * Updates the featureSample1, passing the feature id, the new feature value and the type of the new value as a parameter.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Features->updateOne($featureId, 2, 'integer');

    /**
     * Prints api call response to Features endpoint.
     */
    echo 'Update one response:';
    print_r($response['data']);
    echo PHP_EOL;
}

/**
 * Creates or updates a feature.
 * The upsertOne method checks if the feature already exists on the database, if so, it updates it. Otherwise, it creates a new feature.
 * To create or update a feature it is necessary to call the method upsertOne() passing the source id, the name of the feature, the value of the feature and the type of the new value as a parameter.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Features->upsertOne($sourceId, 'name-test-1', 'value-test-1', 'string');

/**
 * Checks if the feature was created before calling other methods related to the features endpoint (requires an existing feature).
 */
if ($response['status'] === true) {

    /**
     * Retrieves information of the feature created/updated giving the feature id (provided by the upsertOne() method call response).
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Features->getOne($response['data']['id']);

    /**
     * Prints api call response to Features endpoint.
     */
    echo 'Retrieving one feature:', PHP_EOL;
    print_r($response['data']);
    echo PHP_EOL;
}

/**
 * Creates or updates more than one feature once
 * The upsertBulk works pretty the same as the upsertOne, except it allows to create/update more than one feature once.
 * To create or update more than one feature once, it is necessary to call the method upsertBulk() passing an array as parameter, and for each index, it must contain the source id, the name of the feature, the value of the feature and the type of the new value.
 */
$sdk
    ->Profile($credentials['username'])
    ->Features->upsertBulk(
        [
            [
                'source_id'  => $sourceId,
                'name'       => 'name-test-1',
                'value'      => 'value-test-1-changed',
                'type'       => 'string'
            ],
            [
                'source_id'  => $sourceId,
                'name'       => 'name-test-2',
                'value'      => 'value-test-2-changed',
                'type'       => 'string'
            ],
            [
                'source_id'  => $sourceId,
                'name'       => 'name-test-3',
                'value'      => 'value-test-3-changed',
                'type'       => 'string'
            ]
        ]
    );

/**
 * Lists all features related to the username provided.
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Features->listAll();

/**
 * Prints api call response to Features endpoint.
 */
echo 'Listing all features:', PHP_EOL;
foreach ($response['data'] as $feature) {
    print_r($feature);
    echo PHP_EOL;
}
