<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/settings.php';

/**
 * For SSO no header Authorization is necessary
 */
$auth = new \idOS\Auth\None();

/**
 * Calls the create method that instantiates the SDK passing the auth object trought the constructor
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Lists all processes
 */
$response = $sdk
	->Sso
	->listAll();

/**
 * Prints the api response
 */
print_r($response);

/**
 * Retrieves the facebook provider
 */
$response = $sdk
	->Sso
	->getOne('facebook');

/**
 * Prints the response
 */
print_r($response);
