<?php

use Zimosworld\SSLTools\SSLTools;
use Zimosworld\Tests\TestCase\BaseTestCase;

/**
 * Class DecodeCertificateRequestTest
 */
class DecodeCertificateRequestTest extends BaseTestCase {

	/**
	 * Test a decode of a certificate request
	 *
	 * @throws Exception
	 */
	public function testDecode() {

		$decode = new SSLTools();
		$result = $decode->decodeCertificateRequest( $this->getCertificateRequest() );

		$this->assertEquals( 'ssltools.sslutil.com', $result->getCommonName() );
		$this->assertEquals( 'SSL Test', $result->getOrganization() );
		$this->assertEquals( 'Development', $result->getOrganizationUnit() );
		$this->assertEquals( 'Sydney', $result->getCity() );
		$this->assertEquals( 'NSW', $result->getState() );
		$this->assertEquals( 'AU', $result->getCountryCode() );
		$this->assertEquals( '2048', $result->getKeySize() );
		$this->assertNull( $result->getEmail() );
	}

	/**
	 * Test to confirm a exception is thrown if an invalid certificate request is passed in
	 *
	 * @expectedException Exception
	 */
	public function testException() {

		$certificateRequest = 'Not a valid certificate request';

		$decode = new SSLTools();
		$this->expectException( $decode->decodeCertificateRequest( $certificateRequest ) );

	}
}