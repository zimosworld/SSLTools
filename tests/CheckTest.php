<?php

use Zimosworld\Tests\TestCase\BaseTestCase;

/**
 * Class CheckTest
 */
class CheckTest extends BaseTestCase
{
    /**
     * CheckTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test if the check installed SSL works
     *
     * @throws Exception
     */
    public function testCheck()
    {
        $result = $this->sslTools->checkInstalledCertificate('http://google.com');

        $this->assertEquals(443, $result->getPort());
        $this->assertEquals('google.com', $result->getLookupHost());
        $this->assertTrue($result->isValidIssuer());

        $certificateChain = $result->getCertificateChain();

        $this->assertNotEmpty($certificateChain);
        $this->assertEquals('*.google.com', $certificateChain[0]->getCommonName());
        $this->assertFalse($certificateChain[0]->isExpired());
        $this->assertTrue($certificateChain[0]->isHostMatch());

    }

}