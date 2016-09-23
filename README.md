Veridu idOS PHP SDK
===================

Installation
------------
This library can be found on [Packagist](https://packagist.org/packages/veridu/veridu-php).
The recommended way to install this is through [composer](http://getcomposer.org).

Edit your `composer.json` and add:

```json
{
    "require": {
        "veridu/idos-sdk-php": "@stable(what version is it going to be?)"
    }
}
```

And install dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

Examples
--------
Examples of basic usage are located in the src/codeSamples/ directory.

Bugs and feature requests
-------------------------
Have a bug or a feature request? [Please open a new issue](https://github.com/veridu/idos-sdk-php/issues).
Before opening any issue, please search for existing issues and read the [Issue Guidelines](https://github.com/necolas/issue-guidelines), written by [Nicolas Gallagher](https://github.com/necolas/).

Versioning
----------
This SDK will be maintained under the Semantic Versioning guidelines as much as possible.

Releases will be numbered with the following format:

`<major>.<minor>.<patch>`

And constructed with the following guidelines:

* Breaking backward compatibility bumps the major (and resets the minor and patch)
* New additions without breaking backward compatibility bumps the minor (and resets the patch)
* Bug fixes and misc changes bumps the patch

For more information on SemVer, please visit [http://semver.org/](http://semver.org/).

Tests
-----
To run the tests, you must install dependencies with `composer install --dev`.

How To Use The New SDK
----------------------

To make requests to the API, the majority of the endpoints require Authentication tokens. They can be UserToken, CredentialToken or IdentityToken.

### First Step

The first step is to create an auth object passing through its constructor the credentials necessary for the request intended.

```php
/**
 * Instantiates an auth object of CredentialToken Class.
 * Foreach type of Authorization, there is a Class to be instantiated.
 */
$auth = new \idOS\Auth\CredentialToken(
	$credentials['credentialPublicKey'],
	$credentials['handlerPublicKey'],
	$credentials['handlerPrivKey']
);

```
### Second Step

The second step is to instantiate the SDK itself, calling the static method create

```php
$sdk = \idOS\SDK::create($auth);

```

### Third Step

The third step is to calling the endpoints.
For now we support all endpoints related to the users.
To make it easier, every fragment of the request is separated in different classes.

```php
/**
 * Making a /GET request to scores endpoint, listing all scores.
 */
$response = $sdk
    ->Profile($credentials['username']) //passing the username in the Profile Class constructor
    ->Scores->listAll();

/**
 * Making a /POST request to gates endpoint, creating a new gate
 */
$response = $sdk
	->Profile($credentials['username']) //passing the username in the Profile Class constructor
	->Gates->createNew('18+', true);

```
To see more examples of how to use the SDK and how to call the methods and endpoints, go to the ```src/codeSamples``` directory.
