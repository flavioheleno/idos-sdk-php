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
 * Deletes all features
 */
$sdk
	->Profile($credentials['username'])
    ->Features->deleteAll();

/**
 * Deletes all sources to be able to create a new one and avoid creating a repeated source.
 */
$sdk
    ->Profile($credentials['username'])
    ->Sources->deleteAll();

$source = $sdk
    ->Profile($credentials['username'])
    ->Sources->createNew('name-test', ['tag-1' => 'value-1', 'tag-2' => 'value-2']);

/**
 * Stores the source id of the created source
 */
$sourceId = $source['data']['id'];

/**
 * Creates new features
 */
$feature1 = $sdk
	->Profile($credentials['username'])
	->Features->createNew($sourceId, 'name-test-1', 'value-test-1', 'string');

$feature2 = $sdk
    ->Profile($credentials['username'])
    ->Features->createNew($sourceId, 'name-test-2', 3, 'integer');


if (($feature1['status'] === true) || ($feature2['status'] === true)) {
	/**
	 * Lists all features
	 */
	$response = $sdk
	    ->Profile($credentials['username'])
		->Features->listAll();

	/**
	 * Prints the api response
	 */
	print_r("List All: ");
	foreach ($response['data'] as $feature) {
		print_r("\nID: " . $feature['id']);
		print_r("\nSource: " . $feature['source']);
		print_r("\nName: " . $feature['name']);
		print_r("\nType: " . $feature['type']);
		print_r("\nValue: " . $feature['value']);
		print_r("\n");
	}

	/**
	 * Updates a feature
	 */
	$response = $sdk
        ->Profile($credentials['username'])
        ->Features->updateOne($feature1['data']['id'], 2, 'integer');
    /**
     * Prints the updated feature
     */
    print_r("\nUpdate One: ");
    print_r("\nID: " . $feature['id']);
	print_r("\nSource: " . $feature['source']);
	print_r("\nName: " . $feature['name']);
	print_r("\nType: " . $feature['type']);
	print_r("\nValue: " . $feature['value']);
	print_r("\n");
}

/**
 * Creates or updates a feature
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Features->upsertOne($sourceId, 'name-test-1', 'value-test-1', 'string');

if ($response['status'] === true) {
	/**
	 * Gets the feature created/updated source giving the sourceId
	 */
	$response = $sdk
		->Profile($credentials['username'])
		->Features->getOne($response['data']['id']);

	/**
	 * Prints the feature data
	 */
	print_r("\nID: " . $feature['id']);
	print_r("\nSource: " . $feature['source']);
	print_r("\nName: " . $feature['name']);
	print_r("\nType: " . $feature['type']);
	print_r("\nValue: " . $feature['value']);
	print_r("\n");
}

/**
 * Creates or updates more than one feature once
 */
$sdk
    ->Profile($credentials['username'])
    ->Features->upsertBulk(
    	[
	        [
	        	'source_id' => $sourceId,
		        'name'       => 'name-test-1',
		        'value'      => 'value-test-1-changed',
		        'type'       => 'string'
		    ],
	        [
	        	'source_id' => $sourceId,
		        'name'       => 'name-test-2',
		        'value'      => 'value-test-2-changed',
		        'type'       => 'string'
		    ],
		    [
		    	'source_id' => $sourceId,
		        'name'       => 'name-test-3',
		        'value'      => 'value-test-3-changed',
		        'type'       => 'string'
		    ]
    	]
    );

/**
 * Lists all features
 */
$response = $sdk
    ->Profile($credentials['username'])
    ->Features->listAll();

/**
 * Prints the api response
 */
foreach ($response['data'] as $feature) {
	print_r("\nID: " . $feature['id']);
	print_r("\nSource: " . $feature['source']);
	print_r("\nName: " . $feature['name']);
	print_r("\nType: " . $feature['type']);
	print_r("\nValue: " . $feature['value']);
	print_r("\n");
}
