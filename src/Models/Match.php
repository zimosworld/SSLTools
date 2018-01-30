<?php

namespace Zimosworld\SSLTools\Models;

/**
 * Represents result from matching a certificate to a private key or CertificateRequest
 *
 * Class Match
 * @package Zimosworld\SSLTools\Models
 */
class Match
{

    /**
     * OpenSSL Certificate command
     */
    CONST TYPE_CERTIFICATE = 'x509';

    /**
     * OpenSSL Certificate Request command
     */
    CONST TYPE_CERTIFICATE_REQUEST = 'req';

    /**
     * OpenSSL Private Key command
     */
    CONST TYPE_PRIVATE_KEY = 'rsa';

    /**
     * @var string
     */
    private $privateKeyHash;

    /**
     * @var string
     */
    private $certificateRequestHash;

    /**
     * @var string
     */
    private $certificateHash;

    /**
     * @var string
     */
    private $match;

    /**
     * Match constructor.
     *
     * @param string $certificateHash
     * @param boolean $match
     * @param string $privateKeyHash
     * @param string $certificateRequestHash
     */
    public function __construct($certificateHash = null, $match = false, $privateKeyHash = null, $certificateRequestHash = null)
    {
        $this->privateKeyHash = $privateKeyHash;
        $this->certificateRequestHash = $certificateRequestHash;
        $this->certificateHash = $certificateHash;
        $this->match = $match;
    }

    /**
     * @return string
     */
    public function getPrivateKeyHash()
    {
        return $this->privateKeyHash;
    }

    /**
     * @param string $privateKeyHash
     */
    public function setPrivateKeyHash($privateKeyHash)
    {
        $this->privateKeyHash = $privateKeyHash;
    }

    /**
     * @return string
     */
    public function getCertificateRequestHash()
    {
        return $this->certificateRequestHash;
    }

    /**
     * @param string $certificateRequestHash
     */
    public function setCertificateRequestHash($certificateRequestHash)
    {
        $this->certificateRequestHash = $certificateRequestHash;
    }

    /**
     * @return string
     */
    public function getCertificateHash()
    {
        return $this->certificateHash;
    }

    /**
     * @param string $certificateHash
     */
    public function setCertificateHash($certificateHash)
    {
        $this->certificateHash = $certificateHash;
    }

    /**
     * @return string
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param string $match
     */
    public function setMatch($match)
    {
        $this->match = $match;
    }

    /**
     * Compares to confirm if certificate and certificate request go together
     */
    public function doCertificateRequestCompare()
    {

        $isMatch = ($this->getCertificateHash() === $this->getCertificateRequestHash());

        $this->setMatch($isMatch);
    }

    /**
     * Get's values and puts into an array
     *
     * @param array $fields
     *
     * @return array
     */
    public function toArray($fields = [])
    {

        $result = [
            'private_key_hash' => $this->getPrivateKeyHash(),
            'certificate_request_hash' => $this->getCertificateRequestHash(),
            'certificate_hash' => $this->getCertificateHash(),
            'match' => $this->getMatch()
        ];

        if (!empty($fields)) {
            $result = array_intersect_key($result, array_flip($fields));
        }

        return $result;
    }
}