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
 * Creates new raw data
 */
$raw1 = $sdk
    ->Profile($credentials['username'])
    ->Raw->createNew($sourceId, 'name-test-1', ['data-1' => [1, 2, 3], 'data-2' => [4, 5, 6]]);
$raw2 = $sdk
    ->Profile($credentials['username'])
    ->Raw->createNew($sourceId, 'name-test-2', ['data-1' => [4, 5, 6], 'data-2' => [1, 2, 3]]);

if (($raw1['status'] === true) || ($raw2['status'] === true)) {
    /**
     * Lists all raw for the given username.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Raw->listAll();

    /**
     * Prints the api response.
     */
    foreach ($response['data'] as $raw) {
    	print_r("\nCollection: " . $raw['collection']);
        print_r("\nSource: ");
        if (is_array($raw['source'])) {
            //Prints the keys and values of the source array from the response
            print_r("\nID: " . $raw['source']['id']);
            print_r("\nName: " . $raw['source']['name']);
            print_r("\nTags: ");
            if (is_array($raw['source']['tags'])) {
                foreach ($raw['source']['tags'] as $tags) {
                    //prints the values of the keys from the tags array
                    print_r($tags . "; ");
                }
            }
            if(is_array($raw['data'])) {
                print_r("\nData: ");
                //prints the keys and values of the data key from the api response
                foreach ($raw['data'] as $key => $data) {
                    print_r("\n" . $key . ": ");
                    foreach ($data as $value) {
                        print_r($value . "; ");
                    }
                }
            }
        }
    	print_r("\n");
    }
}
