<?php

namespace Zimosworld\SSLTools\Services;

use Zimosworld\SSLTools\Exception\CertificateParseException;
use Zimosworld\SSLTools\Exception\CertificateRequestParseException;
use Zimosworld\SSLTools\Exception\PrivateKeyParseException;
use Zimosworld\SSLTools\Models\Match;

/**
 * Class MatchService
 * @package Zimosworld\SSLTools\Services
 */
class MatchService extends BaseService implements MatchInterface
{

    /**
     * MatchService constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get's hash for Certificate and Private Key then compares to confirm if they go together
     *
     * @param $privateKey
     * @param $certificate
     *
     * @return mixed|Match
     */
    public function matchWithPrivateKey($privateKey, $certificate)
    {

        $certificateDetails = openssl_x509_parse($certificate);

        if (!$certificateDetails) {
            throw new CertificateParseException("Certificate parse failed");
        }

        $privateKeyDetails = openssl_pkey_get_private($privateKey);

        if (!$privateKeyDetails) {
            throw new PrivateKeyParseException("Private Key parse failed");
        }

        $match = new Match();

        $match->setCertificateHash($this->getHash($certificate));
        $match->setPrivateKeyHash($this->getHash($privateKey, Match::TYPE_PRIVATE_KEY));

        $match->setMatch(openssl_x509_check_private_key($certificate, $privateKey));

        return $match;
    }

    /**
     * Get's hash for Certificate and Certificate request then compares to confirm if they go together
     *
     * @param $certificateRequest
     * @param $certificate
     *
     * @return mixed|Match
     */
    public function matchWithCSR($certificateRequest, $certificate)
    {

        $certificateDetails = openssl_x509_parse($certificate);

        if (!$certificateDetails) {
            throw new CertificateParseException("Certificate parse failed");
        }

        $certificateRequestDetails = openssl_csr_get_subject($certificateRequest);

        if (!$certificateRequestDetails) {
            throw new CertificateRequestParseException("Certificate Request (CSR) parse failed");
        }
        $match = new Match();

        $match->setCertificateHash($this->getHash($certificate));
        $match->setCertificateRequestHash($this->getHash($certificateRequest, Match::TYPE_CERTIFICATE_REQUEST));

        $match->doCertificateRequestCompare();

        return $match;
    }

    /**
     * Generates hash for key/certificate request/certificate
     *
     * @param $certificate
     * @param string $type
     *
     * @return string
     */
    private function getHash($certificate, $type = Match::TYPE_CERTIFICATE)
    {

        $tmpFile = "tmp_{$type}_file" . hash('sha256', time());
        file_put_contents($tmpFile, $certificate);

        $command = "openssl {$type} -noout -modulus -in {$tmpFile} | openssl sha256";
        $hash = shell_exec($command);

        shell_exec("rm {$tmpFile}");

        return trim(str_replace('(stdin)=', '', $hash));
    }

}