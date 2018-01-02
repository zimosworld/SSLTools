<?php namespace Zimosworld\SSLTools\Services;

/**
 * Interface CheckInterface
 * @package Zimosworld\SSLTools\Services
 */
interface CheckInterface {

	/**
	 * @param string $hostname
	 *
	 * @return mixed
	 */
	public function checkInstalledCertificate( $hostname = '' );
}