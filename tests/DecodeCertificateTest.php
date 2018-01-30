<?php

use Zimosworld\Tests\TestCase\BaseTestCase;

/**
 * Class DecodeCertificateTest
 */
class DecodeCertificateTest extends BaseTestCase
{
    /**
     * DecodeCertificateTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test decode a certificate
     *
     * @throws Exception
     */
    public function testDecode()
    {

        $result = $this->sslTools->decodeCertificate($this->getCertificate());

        $this->assertEquals('ssltools.sslutil.com', $result->getCommonName());
        $this->assertEquals('SSL Test', $result->getOrganization());
        $this->assertEquals('Development', $result->getOrganizationUnit());
        $this->assertEquals('AU', $result->getCountryCode());
        $this->assertEquals('1514617406', $result->getValidFrom());
        $this->assertEquals('1546153406', $result->getValidTo());
        $this->assertEquals('2048', $result->getKeySize());
        $this->assertEquals('14225341186233066637', $result->getSerialNumber());
        $this->assertNull($result->getSubjectAltName());
        $this->assertNotEmpty($result->getIssuer());
    }

    /**
     * Test to confirm an exception is thrown if an invalid certificate is passed in
     *
     * @expectedException Exception
     */
    public function testException()
    {
        $certificate = 'Not a valid certificate';

        $this->expectException($this->sslTools->decodeCertificate($certificate));

    }
}