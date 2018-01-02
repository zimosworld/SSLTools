<?php

use Zimosworld\SSLTools\SSLTools;
use Zimosworld\Tests\TestCase\BaseTestCase;

/**
 * Class MatchTest
 */
class MatchTest extends BaseTestCase {

	/**
	 * Test to confirm matching of a private key and certificate work
	 *
	 * @throws Exception
	 */
	public function testPrivateKeyMatch() {

		$match  = new SSLTools();
		$result = $match->matchWithPrivateKey( $this->getPrivateKey(), $this->getCertificate() );

		$this->assertTrue( $result->getMatch() );
		$this->assertNotNull( $result->getPrivateKeyHash() );
		$this->assertNotNull( $result->getCertificateHash() );
		$this->assertNotNull( ! $result->getCertificateRequestHash() );
	}

	/**
	 * Test to confirm matching of a certificate request and certificate work
	 *
	 * @throws Exception
	 */
	public function testCertificateRequestMatch() {

		$match  = new SSLTools();
		$result = $match->matchWithCSR( $this->getCertificateRequest(), $this->getCertificate() );

		$this->assertTrue( $result->getMatch() );
		$this->assertNotNull( $result->getCertificateRequestHash() );
		$this->assertNotNull( $result->getCertificateHash() );
		$this->assertNotNull( ! $result->getPrivateKeyHash() );
	}

}