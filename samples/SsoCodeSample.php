<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/settings.php';

/**
 * To instantiate the $sdk object, which is responsible for calling the endpoints, it is necessary to create the $auth object.
 * The $auth object can instantiate the CredentialToken class, IdentityToken class, UserToken class or None class. They relate to the type of authorization required by the endpoint.
 * For SSO, no header Authorization is necessary, in that way, the None Class need to be instantiated to instantiate the $sdk object.
 */
$auth = new \idOS\Auth\None();

/**
 * The proper way to call the endpoints is to statically calling the create method of the SDK class.
 * The static method create($auth) creates a new instance of the SDK class.
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Checks if a provider is enabled, passing the name of the provider as parameter.
 */
$response = $sdk
    ->Sso
    ->getOne('facebook');

/**
 * Prints api call response to SSO endpoint.
 */
printf('Enabled: %s', $response['data']['enabled']);
echo PHP_EOL;

/**
 * Creates an OAuth2 type SSO, passing as parameter: the name of the provider, the credential public key, and the user access token.
 *
 * Note: You should replace "accessToken" with a valid Facebook access token.
 */
$response = $sdk
    ->Sso
    ->createNew('facebook', $credentials['credentialPublicKey'], 'accessToken');

/**
 * Prints api call response to SSO endpoint.
 */
echo 'FACEBOOK:', PHP_EOL;
print_r($response['data']);
echo PHP_EOL;

/**
 * Creates an OAuth1 type SSO, passing as parameter: the name of the provider, the credential public key, the user access token and the token secret.
 *
 * Note: You should replace "accessToken" and "tokenSecret" with a valid Twitter access token / token secret.
 */
$response = $sdk
    ->Sso
    ->createNew('twitter', $credentials['credentialPublicKey'], 'accessToken', 'tokenSecret');

/**
 * Prints api call response to SSO endpoint.
 */
echo 'TWITTER:', PHP_EOL;
print_r($response['data']);
echo PHP_EOL;
