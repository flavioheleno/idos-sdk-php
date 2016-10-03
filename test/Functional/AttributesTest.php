<?php

namespace Test\Functional;

class AttributesTest extends AbstractFunctional {

	protected $sdk;

	protected function setUp () {
		$auth = new \idOS\Auth\CredentialToken(
    		$credentials['credentialPublicKey'],
		    $credentials['handlerPublicKey'],
		    $credentials['handlerPrivKey']
		);

		/**
		 * Calls the create method that instantiates the SDK passing the auth object trought the constructor.
		 */
		$this->sdk = \idOS\SDK::create($auth);
	}

	/**
	 * @test
	 */
	public function createOne() {
		$response = $this->sdk
		    ->Profile($credentials['username'])
		    ->Attributes->createNew('attribute', 'value-test', 1.2);

		$this->assertTrue($response['status']);
	}
}
