<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/settings.php';

/**
 * For SSO no header Authorization is necessary.
 */
$auth = new \idOS\Auth\None();

/**
 * Calls the create method that instantiates the SDK passing the auth object trought the constructor.
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Lists all processes.
 */
$response = $sdk
    ->Sso
    ->listAll();

/**
 * Prints the api response.
 */
print_r("\nList of providers: ");

foreach ($response['data'] as $provider) {
	print_r($provider . "; ");
}

print_r("\n");

/**
 * Retrieves the facebook provider.
 */
$response = $sdk
    ->Sso
    ->getOne('facebook');

/**
 * Prints boolean value if enabled or not.
 */
print_r("\nEnabled: " . $response['data']['enabled']);
print_r("\n");
/**
 * Creates a facebook sso.
 *
 * Note: You should replace "accessToken" with a valid Facebook access token.
 */
$response = $sdk
    ->Sso
    ->createNew('facebook', $credentials['credentialPublicKey'], 'userToken');

/**
 * Prints the username and the user token.
 */
print_r("\nFACEBOOK:");
print_r("\nUsername: " . $response['data']['username']);
print_r("\nUser token: " . $response['data']['user_token']);
print_r("\n");
/**
 * Creates a twitter sso.
 *
 * Note: You should replace "accessToken" and "tokenSecret" with a valid Twitter access token / token secret.
 */
$response = $sdk
    ->Sso
    ->createNew('twitter', $credentials['credentialPublicKey'], 'userToken', 'tokenSecret');

/**
 * Prints the username and the user token.
 */
print_r("\nTWITTER:");
print_r("\nUsername: " . $response['data']['username']);
print_r("\nUser token: " . $response['data']['user_token']);
print_r("\n");
