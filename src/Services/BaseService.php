<?php

namespace Zimosworld\SSLTools\Services;

use Exception;
use Zimosworld\SSLTools\Models\Certificate;

/**
 * Class BaseService
 * @package Zimosworld\SSLTools\Services
 */
class BaseService {

	/**
	 * BaseService constructor.
	 */
	public function __construct() {
	}

	/**
	 * Retrieves information for certificate
	 *
	 * @param $certificate
	 *
	 * @return Certificate
	 * @throws Exception
	 */
	public function decodeCertificate( $certificate ) {

		$certificateDetails = openssl_x509_parse( $certificate );

		if ( ! $certificateDetails ) {
			throw new Exception( "Certificate parse failed" );
		}

		$keyDetails = openssl_pkey_get_details( openssl_pkey_get_public( $certificate ) );

		$subjectAltName = null;
		if ( ! empty( $certificateDetails['extensions']['subjectAltName'] ) ) {
			$subjectAltName = str_replace( 'DNS:', '', $certificateDetails['extensions']['subjectAltName'] );
		}

		$hasEv = false;
		if( ! empty( $certificateDetails['subject']['UNDEF'] ) ) {
			$hasEv = true;
		}

		return new Certificate(
			$certificateDetails['subject']['CN'],
			$subjectAltName,
			$certificateDetails['subject']['O'],
			( empty( $certificateDetails['subject']['OU'] ) ? null : $certificateDetails['subject']['OU'] ),
			$certificateDetails['subject']['C'],
			$certificateDetails['validFrom_time_t'],
			$certificateDetails['validTo_time_t'],
			$certificateDetails['issuer'],
			$keyDetails['bits'],
			$certificateDetails['serialNumber'],
			$hasEv
		);
	}

}