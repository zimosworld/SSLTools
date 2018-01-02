<?php

namespace Zimosworld\SSLTools\Services;

use Exception;
use Zimosworld\SSLTools\Models\Check;

/**
 * Class CheckService
 * @package Zimosworld\SSLTools\Services
 */
class CheckService extends BaseService implements CheckInterface {

	/**
	 * @var Check
	 */
	private $check;

	/**
	 * CheckService constructor.
	 */
	public function __construct() {
		parent::__construct();

		$this->check = new Check();
	}

	/**
	 * @param string $url
	 *
	 * @return Check
	 * @throws \Exception
	 */
	public function checkInstalledCertificate( $url = '' ) {

		$this->determineLookupType( $url );
		$this->runLookup();
		$this->checkIssuer();

		return $this->check;
	}

	/**
	 * Determine lookup type and split out hostname and port
	 *
	 * @param $url
	 *
	 * @throws Exception
	 */
	private function determineLookupType( $url ) {

		switch ( true ) {
			case ( filter_var( $url, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 ) ) :
				$this->check->setLookupHost( "[{$url}]" );
				break;
			case ( filter_var( $url, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) :
				$this->check->setLookupHost( $url );
				break;
			case ( filter_var( $url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED ) ) :

				$parsedHost = parse_url( $url );

				if ( empty( $parsedHost['host'] ) ) {
					throw new Exception( 'Invalid lookup host' );
				}

				$this->check->setLookupHost( $parsedHost['host'] );

				if ( ! empty( $parsedHost['port'] ) ) {
					$this->check->setPort( $parsedHost['port'] );
				}
				break;
			default:
				throw new Exception( 'Invalid lookup host' );
				break;
		}

	}

	/**
	 * Get's the chain of certificates and decodes them
	 *
	 * @throws \Exception
	 */
	private function runLookup() {

		$checkHostname = "ssl://{$this->check->getLookupHost()}:{$this->check->getPort()}";

		$stream = stream_context_create();

		stream_context_set_option( $stream, 'ssl', 'capture_peer_cert_chain', true );

		$streamClient = @stream_socket_client( $checkHostname, $errorNo, $errorStr, 30, STREAM_CLIENT_CONNECT, $stream );

		if ( ! $streamClient ) {
			throw new Exception( 'Unknown lookup error occurred' );
		}

		$streamContent = stream_context_get_params( $streamClient );

		$loop             = 0;
		$certificateChain = [];
		foreach ( $streamContent['options']['ssl']['peer_certificate_chain'] as $certificate ) {

			try {
				$certificateChain[ $loop ] = $this->decodeCertificate( $certificate );

				if ( $loop == 0 ) {
					$certificateChain[ $loop ]->checkHostMatch( $this->check->getLookupHost() );
				}
			} catch ( Exception $exception ) {
				throw new Exception( $exception->getMessage() );
			}

			$loop ++;
		}

		$this->check->setCertificateChain( $certificateChain );
	}

	/**
	 * Check if the issuer will be valid in most browsers
	 */
	private function checkIssuer() {

		$checkHostname = "ssl://{$this->check->getLookupHost()}:{$this->check->getPort()}";

		$stream = stream_context_create();

		$certificateLocations = openssl_get_cert_locations();

		stream_context_set_option( $stream, 'ssl', 'capath', $certificateLocations['default_cert_dir'] );
		stream_context_set_option( $stream, 'ssl', 'verify_peer', true );

		$streamClient = @stream_socket_client( $checkHostname, $errorNo, $errorString, 30, STREAM_CLIENT_CONNECT, $stream );

		if( ! $streamClient ) {
			$this->check->setValidIssuer( true );
		}
	}

}