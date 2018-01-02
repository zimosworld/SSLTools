<?php

namespace Zimosworld\SSLTools\Models;

/**
 * Represents a response from decoding a certificate request
 *
 * Class CertificateRequest
 * @package Zimosworld\SSLTools\Models
 */
class CertificateRequest {

	/**
	 * @var string
	 */
	private $commonName;

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
	private $city;

	/**
	 * @var string
	 */
	private $state;

	/**
	 * @var string
	 */
	private $countryCode;

	/**
	 * @var string
	 */
	private $email;

	/**
	 * @var string
	 */
	private $keySize;

	/**
	 * CertificateRequest constructor.
	 *
	 * @param string $commonName
	 * @param string $organization
	 * @param string $organizationUnit
	 * @param string $city
	 * @param string $state
	 * @param string $countryCode
	 * @param string $email
	 * @param string $keySize
	 */
	public function __construct( $commonName, $organization, $organizationUnit, $city, $state, $countryCode, $email, $keySize ) {
		$this->commonName       = $commonName;
		$this->organization     = $organization;
		$this->organizationUnit = $organizationUnit;
		$this->city             = $city;
		$this->state            = $state;
		$this->countryCode      = $countryCode;
		$this->email            = $email;
		$this->keySize          = $keySize;
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
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param string $city
	 */
	public function setCity( $city ) {
		$this->city = $city;
	}

	/**
	 * @return string
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @param string $state
	 */
	public function setState( $state ) {
		$this->state = $state;
	}

	/**
	 * @return string
	 */
	public function getcountryCode() {
		return $this->countryCode;
	}

	/**
	 * @param string $countryCode
	 */
	public function setcountryCode( $countryCode ) {
		$this->countryCode = $countryCode;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail( $email ) {
		$this->email = $email;
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
	 * Get's values and puts into an array
	 *
	 * @param array $fields
	 *
	 * @return array
	 */
	public function toArray( $fields = [] ) {

		$result = [
			'common_name' => $this->getCommonName(),
			'organization' => $this->getOrganization(),
			'organization_unit' => $this->getOrganizationUnit(),
			'city' => $this->getCity(),
			'state' => $this->getState(),
			'country_code' => $this->getcountryCode(),
			'email' => $this->getEmail(),
			'key_size' => $this->getKeySize()
		];

		if ( ! empty( $fields ) ) {
			$result = array_intersect_key( $result, array_flip( $fields ) );
		}

		return $result;
	}

}