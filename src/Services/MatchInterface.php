<?php

namespace Zimosworld\SSLTools\Services;

/**
 * Interface MatchInterface
 * @package Zimosworld\SSLTools\Services
 */
interface MatchInterface {

	/**
	 * @param $privateKey
	 * @param $certificate
	 *
	 * @return mixed
	 */
	public function matchWithPrivateKey( $privateKey, $certificate );

	/**
	 * @param $certificateRequest
	 * @param $certificate
	 *
	 * @return mixed
	 */
	public function matchWithCSR( $certificateRequest, $certificate );

}