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
 * Creates candidates to be listed in the attributes endpoint.
 * To create a new candidate, its necessary to call the function createNew() passing as parameter the attribute name, the value of the attribute and the support value.
 */
$email = $sdk
    ->Profile($credentials['username'])
    ->Candidates->createNew('email', 'jhon@jhon.com', 0.9);
$gender = $sdk
    ->Profile($credentials['username'])
    ->Candidates->createNew('gender', 'male', 0.8);

/**
 * Checks if at least one attribute was created before calling other methods related to the attributes endpoint that requires an existing attribute.
 */
if (($email['status'] === true) || ($gender['status'] === false)) {

    /**
     * Attributes requires UserToken instead of CredentialToken (that was used to create new Candidates in this sample). So, its necessary to instantiate a new $auth object.
     * Creates an auth object for a UserToken required in the SDK constructor for calling all endpoints. Passing through the UserToken constructor: the username, credential public key and crecendial private key, so the auth token can be generated.
     */
    $auth = new \idOS\Auth\UserToken(
        $credentials['username'],
        $credentials['credentialPublicKey'],
        $credentials['credentialPrivKey']
    );

    /**
     * Instantiating the SDK again, now passing the auth object related to the UserToken through the constructor.
     */
    $sdk = \idOS\SDK::create($auth);

    /**
     * Lists all attributes related to the username provided.
     */
    $response = $sdk
        ->Profile($credentials['username'])
        ->Attributes->listAll();

    /**
     * Prints api call response to Attributes endpoint.
     */
    echo 'Attributes:', PHP_EOL;

    foreach ($response['data'] as $attribute) {
        print_r($attribute);
        echo PHP_EOL;
    }
}
