<?php

namespace Test\Unit\idOS;


abstract class AbstractUnitTest extends \PHPUnit_Framework_TestCase {
	protected $sdk;
	protected $auth;
	protected $credentials;

	protected function setUp() {
		/**
		 * Saves into the credentials variable all credentials necessary for testing the endpoints.
		 */
		$this->credentials = [
			'credentialPublicKey' => 'credentialPublicKey',
			'credentialPrivKey' => 'credentialPrivKey',
			'handlerPublicKey' => 'handlerPublicKey',
			'handlerPrivKey' => 'handlerPrivKey',
			'userName' => 'userName'
		];

	}
}
