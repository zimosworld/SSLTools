<?php

namespace Zimosworld\SSLTools\Services;

/**
 * Interface DecodeInterface
 * @package Zimosworld\SSLTools\Services
 */
interface DecodeInterface {

	/**
	 * @param $certificate
	 *
	 * @return mixed
	 */
	public function decodeCertificate( $certificate );

	/**
	 * @param $certificateRequest
	 *
	 * @return mixed
	 */
	public function decodeCertificateRequest( $certificateRequest );

}

