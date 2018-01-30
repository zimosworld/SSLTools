<?php

use Zimosworld\Tests\TestCase\BaseTestCase;

/**
 * Class MatchTest
 */
class MatchTest extends BaseTestCase
{
    /**
     * MatchTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test to confirm matching of a private key and certificate work
     *
     * @throws Exception
     */
    public function testPrivateKeyMatch()
    {

        $result = $this->sslTools->matchWithPrivateKey($this->getPrivateKey(), $this->getCertificate());

        $this->assertTrue($result->getMatch());
        $this->assertNotNull($result->getPrivateKeyHash());
        $this->assertNotNull($result->getCertificateHash());
        $this->assertNotNull(!$result->getCertificateRequestHash());
    }

    /**
     * Test to confirm matching of a certificate request and certificate work
     *
     * @throws Exception
     */
    public function testCertificateRequestMatch()
    {
        $result = $this->sslTools->matchWithCSR($this->getCertificateRequest(), $this->getCertificate());

        $this->assertTrue($result->getMatch());
        $this->assertNotNull($result->getCertificateRequestHash());
        $this->assertNotNull($result->getCertificateHash());
        $this->assertNotNull(!$result->getPrivateKeyHash());
    }

}