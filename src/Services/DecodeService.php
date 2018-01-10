<?php

namespace Zimosworld\SSLTools\Services;

use Zimosworld\SSLTools\Exception\CertificateRequestParseException;
use Zimosworld\SSLTools\Models\CertificateRequest;

/**
 * Class DecodeService
 * @package Zimosworld\SSLTools\Services
 */
class DecodeService extends BaseService implements DecodeInterface {

	/**
	 * DecodeService constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Retrieves information for certificate request
	 *
	 * @param $certificateRequest
	 *
	 * @return mixed|CertificateRequest
	 */
	public function decodeCertificateRequest( $certificateRequest ) {

		$certRequestDetails = openssl_csr_get_subject( $certificateRequest );

		if ( ! $certRequestDetails ) {
			throw new CertificateRequestParseException( "Certificate Request parse failed" );
		}

		$keyDetails = openssl_pkey_get_details( openssl_csr_get_public_key( $certificateRequest ) );

		if( empty( $certRequestDetails['emailAddress'] ) ) {
			$certRequestDetails['emailAddress'] = null;
		}

		return new CertificateRequest(
			$certRequestDetails['CN'],
			$certRequestDetails['O'],
			$certRequestDetails['OU'],
			$certRequestDetails['L'],
			$certRequestDetails['ST'],
			$certRequestDetails['C'],
			$certRequestDetails['emailAddress'],
			$keyDetails['bits']
		);
	}

}