<?php namespace Zimosworld\SSLTools\Models;

class Check
{

    /**
     * @var string
     */
    private $lookupHost;

    /**
     * @var string
     */
    private $resolvedIp;

    /**
     * @var int
     */
    private $port = 443;

    /**
     * @var bool
     */
    private $validIssuer = false;

    /**
     * @var array
     */
    private $certificateChain = [];

    /**
     * Check constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getLookupHost()
    {
        return $this->lookupHost;
    }

    /**
     * @param mixed $lookupHost
     */
    public function setLookupHost($lookupHost)
    {
        $this->lookupHost = $lookupHost;
    }

    /**
     * @return mixed
     */
    public function getResolvedIp()
    {
        return $this->resolvedIp;
    }

    /**
     * @param mixed $resolvedIp
     */
    public function setResolvedIp($resolvedIp)
    {
        $this->resolvedIp = $resolvedIp;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return bool
     */
    public function isValidIssuer()
    {
        return $this->validIssuer;
    }

    /**
     * @param bool $validIssuer
     */
    public function setValidIssuer($validIssuer)
    {
        $this->validIssuer = $validIssuer;
    }

    /**
     * @return array
     */
    public function getCertificateChain()
    {
        return $this->certificateChain;
    }

    /**
     * @param array $certificateChain
     */
    public function setCertificateChain($certificateChain)
    {
        $this->certificateChain = $certificateChain;
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
            'lookup_host' => $this->getLookupHost(),
            'resolved_ip' => $this->getResolvedIp(),
            'port' => $this->getPort(),
            'valid_issuer' => $this->isValidIssuer()
        ];

        foreach ($this->getCertificateChain() as $certificateChain) {
            $result['certificate_chain'][] = $certificateChain->toArray();
        }

        if (!empty($fields)) {
            $result = array_intersect_key($result, array_flip($fields));
        }

        return $result;
    }
}