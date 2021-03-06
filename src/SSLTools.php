<?php

namespace Zimosworld\SSLTools;

use Zimosworld\SSLTools\Services\DecodeService;
use Zimosworld\SSLTools\Services\MatchService;
use Zimosworld\SSLTools\Services\CheckService;

/**
 * Class SSLTools
 * @package Zimosworld\SSLTools
 */
class SSLTools
{

    /**
     * @var
     */
    protected static $instance;

    /**
     * @var DecodeService
     */
    private $decode;

    /**
     * @var MatchService
     */
    private $match;

    /**
     * @var CheckService
     */
    private $check;

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (null == static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * SSLTools constructor.
     *
     * @param DecodeService|null $decode
     * @param MatchService|null $match
     * @param CheckService|null $check
     */
    protected function __construct(DecodeService $decode = null, MatchService $match = null, CheckService $check = null)
    {

        $this->decode = $decode;
        $this->match = $match;
        $this->check = $check;

        if (empty($decode)) {
            $this->decode = new DecodeService();
        }

        if (empty($match)) {
            $this->match = new MatchService();
        }

        if (empty($check)) {
            $this->check = new CheckService();
        }
    }

    /**
     * @param $certificate
     *
     * @return Models\Certificate
     * @throws \Exception
     */
    public function decodeCertificate($certificate)
    {
        return $this->decode->decodeCertificate($certificate);
    }

    /**
     * @param $certificateRequest
     *
     * @return mixed|Models\CertificateRequest
     */
    public function decodeCertificateRequest($certificateRequest)
    {
        return $this->decode->decodeCertificateRequest($certificateRequest);
    }

    /**
     * @param $privateKey
     * @param $certificate
     *
     * @return mixed|Models\Match
     * @throws \Exception
     */
    public function matchWithPrivateKey($privateKey, $certificate)
    {
        return $this->match->matchWithPrivateKey($privateKey, $certificate);
    }

    /**
     * @param $certificateRequest
     * @param $certificate
     *
     * @return mixed|Models\Match
     */
    public function matchWithCSR($certificateRequest, $certificate)
    {
        return $this->match->matchWithCSR($certificateRequest, $certificate);
    }

    /**
     * @param $url
     * @return Models\Check
     */
    public function checkInstalledCertificate($url)
    {
        return $this->check->checkInstalledCertificate($url);
    }
}