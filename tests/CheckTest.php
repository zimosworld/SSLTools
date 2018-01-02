<?php

use Zimosworld\SSLTools\SSLTools;
use Zimosworld\Tests\TestCase\BaseTestCase;

/**
 * Class CheckTest
 */
class CheckTest extends BaseTestCase {

	/**
	 * Test if the check installed SSL works
	 *
	 * @throws Exception
	 */
	public function testCheck() {

		$check  = new SSLTools();
		$result = $check->checkInstalledCertificate( 'http://google.com' );

		$this->assertEquals( 443, $result->getPort() );
		$this->assertEquals( 'google.com', $result->getLookupHost() );
		$this->assertTrue( $result->isValidIssuer() );

		$certificateChain = $result->getCertificateChain();

		$this->assertNotEmpty( $certificateChain );
		$this->assertEquals( '*.google.com', $certificateChain[0]->getCommonName() );
		$this->assertFalse( $certificateChain[0]->isExpired() );
		$this->assertTrue( $certificateChain[0]->isHostMatch() );

	}

}