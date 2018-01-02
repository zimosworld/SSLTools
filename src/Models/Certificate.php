<?php

namespace Zimosworld\SSLTools\Models;

/**
 * Represents a response from decoding a certificate
 *
 * Class Certificate
 * @package Zimosworld\SSLTools\Models
 */
class Certificate {

	/**
	 * @var string
	 */
	private $commonName;

	/**
	 * @var string
	 */
	private $subjectAltName;

	/**
	 * @var string
	 */
	private $organization;

	/**
	 * @var string
	 */
	private $organizationUnit;

	/**
	 * @var string
	 */
	private $countryCode;

	/**
	 * @var int
	 */
	private $validFrom;

	/**
	 * @var int
	 */
	private $validTo;

	/**
	 * @var string
	 */
	private $issuer;

	/**
	 * @var string
	 */
	private $keySize;

	/**
	 * @var string
	 */
	private $serialNumber;

	/**
	 * @var bool
	 */
	private $expired = true;

	/**
	 * @var bool
	 */
	private $hasEV = false;

	/**
	 * @var bool
	 */
	private $hostMatch = false;

	/**
	 * Certificate constructor.
	 *
	 * @param $commonName
	 * @param $subjectAltName
	 * @param $organization
	 * @param $organizationUnit
	 * @param $countryCode
	 * @param $validFrom
	 * @param $validTo
	 * @param $issuer
	 * @param $keySize
	 * @param $serialNumber
	 * @param bool $hasEv
	 */
	public function __construct( $commonName, $subjectAltName, $organization, $organizationUnit, $countryCode, $validFrom, $validTo, $issuer, $keySize, $serialNumber, $hasEv = false ) {
		$this->commonName       = $commonName;
		$this->subjectAltName   = $subjectAltName;
		$this->organization     = $organization;
		$this->organizationUnit = $organizationUnit;
		$this->countryCode      = $countryCode;
		$this->validFrom        = $validFrom;
		$this->validTo          = $validTo;
		$this->issuer           = $issuer;
		$this->keySize          = $keySize;
		$this->serialNumber     = $serialNumber;
		$this->hasEV            = $hasEv;

		$this->checkIfExpired();
	}

	/**
	 * @return string
	 */
	public function getCommonName() {
		return $this->commonName;
	}

	/**
	 * @param string $commonName
	 */
	public function setCommonName( $commonName ) {
		$this->commonName = $commonName;
	}

	/**
	 * @return string
	 */
	public function getSubjectAltName() {
		return $this->subjectAltName;
	}

	/**
	 * @param string $subjectAltName
	 */
	public function setSubjectAltName( $subjectAltName ) {
		$this->subjectAltName = $subjectAltName;
	}

	/**
	 * @return string
	 */
	public function getOrganization() {
		return $this->organization;
	}

	/**
	 * @param string $organization
	 */
	public function setOrganization( $organization ) {
		$this->organization = $organization;
	}

	/**
	 * @return string
	 */
	public function getOrganizationUnit() {
		return $this->organizationUnit;
	}

	/**
	 * @param string $organizationUnit
	 */
	public function setOrganizationUnit( $organizationUnit ) {
		$this->organizationUnit = $organizationUnit;
	}

	/**
	 * @return string
	 */
	public function getCountryCode() {
		return $this->countryCode;
	}

	/**
	 * @param string $countryCode
	 */
	public function setCountryCode( $countryCode ) {
		$this->countryCode = $countryCode;
	}

	/**
	 * @return int
	 */
	public function getValidFrom() {
		return $this->validFrom;
	}

	/**
	 * @param int $validFrom
	 */
	public function setValidFrom( $validFrom ) {
		$this->validFrom = $validFrom;
	}

	/**
	 * @return int
	 */
	public function getValidTo() {
		return $this->validTo;
	}

	/**
	 * @param int $validTo
	 */
	public function setValidTo( $validTo ) {
		$this->validTo = $validTo;
	}

	/**
	 * @return string
	 */
	public function getIssuer() {
		return $this->issuer;
	}

	/**
	 * @param string $issuer
	 */
	public function setIssuer( $issuer ) {
		$this->issuer = $issuer;
	}

	/**
	 * @return string
	 */
	public function getKeySize() {
		return $this->keySize;
	}

	/**
	 * @param string $keySize
	 */
	public function setKeySize( $keySize ) {
		$this->keySize = $keySize;
	}

	/**
	 * @return string
	 */
	public function getSerialNumber() {
		return $this->serialNumber;
	}

	/**
	 * @param string $serialNumber
	 */
	public function setSerialNumber( $serialNumber ) {
		$this->serialNumber = $serialNumber;
	}

	/**
	 * @return bool
	 */
	public function isExpired() {
		return $this->expired;
	}

	/**
	 * @param bool $expired
	 */
	public function setExpired( $expired ) {
		$this->expired = $expired;
	}

	/**
	 * @return bool
	 */
	public function isHasEV() {
		return $this->hasEV;
	}

	/**
	 * @param bool $hasEV
	 */
	public function setHasEV( $hasEV ) {
		$this->hasEV = $hasEV;
	}

	/**
	 * @return bool
	 */
	public function isHostMatch() {
		return $this->hostMatch;
	}

	/**
	 * @param bool $hostMatch
	 */
	public function setHostMatch( $hostMatch ) {
		$this->hostMatch = $hostMatch;
	}

	/**
	 * Check if certificate is expired
	 */
	public function checkIfExpired() {

		if ( $this->getValidTo() > time() ) {
			$this->setExpired( false );
		}
	}

	/**
	 * Checks if host is a match to common name or is in the SAN
	 *
	 * @param $host
	 */
	public function checkHostMatch( $host ) {

		if( $this->getCommonName() == $host ) {
			$this->setHostMatch( true );
			return;
		}

		if( substr_count( $host, '.' ) > 1 ) {
			$splitHost = explode( '.', $host, 2 );

			$host = $splitHost[1];
		}

		if( "*.{$host}" == $this->getCommonName() ) {
			$this->setHostMatch( true );
			return;
		}

		if( ! empty( $san = $this->getSubjectAltName() ) ) {
			$san .= ',';

			if( preg_match( "/\*.{$host}/", $san ) ) {
				$this->setHostMatch( true );
				return;
			}
		}
	}

	/**
	 * Get's values and puts into an array
	 *
	 * @param array $fields
	 *
	 * @return array
	 */
	public function toArray( $fields = [] ) {

		$result = [
			'common_name'       => $this->getCommonName(),
			'subject_altname'   => $this->getSubjectAltName(),
			'organization'      => $this->getOrganization(),
			'organization_unit' => $this->getOrganizationUnit(),
			'country_code'      => $this->getCountryCode(),
			'valid_from'        => $this->getValidFrom(),
			'valid_to'          => $this->getValidTo(),
			'issuer'            => $this->getIssuer(),
			'key_size'          => $this->getKeySize(),
			'serial_number'     => $this->getSerialNumber(),
			'is_expired'        => $this->isExpired(),
			'is_has_ev'         => $this->isHasEV(),
			'is_host_match'     => $this->isHostMatch()
		];

		if ( ! empty( $fields ) ) {
			$result = array_intersect_key( $result, array_flip( $fields ) );
		}

		return $result;
	}
}