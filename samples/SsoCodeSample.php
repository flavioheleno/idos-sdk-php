<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/settings.php';

/**
 * For SSO no header Authorization is necessary, in that way, the None Class need to be instantiated to be used on creating the $sdk object.
 */
$auth = new \idOS\Auth\None();

/**
 * The proper way to call the endpoints is to statically calling the create method of the SDK class.
 * The static method create($auth) creates a new instance of the SDK class.
 */
$sdk = \idOS\SDK::create($auth);

/**
 * Lists all available providers for the sso.
 */
$response = $sdk
    ->Sso
    ->listAll();

/**
 * Prints api call response to SSO endpoint.
 */
echo 'List of providers: ';

foreach ($response['data'] as $provider) {
    printf('%s; ', $provider);
}
echo PHP_EOL;

/**
 * Retrieves data from one provider, passing the name of the provider. In this example, facebook.
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
 * Creates an OAuth2 type sso.
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
 * Creates an OAuth1 type SSO, passing the name of the provider, the credential public key, the user access token and the token secret.
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
