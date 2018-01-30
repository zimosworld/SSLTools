SSL Tools
===========================

## What is this?

SSL Tools is a set of tools that allows you to

* Decode PEM encoded certificate and certificate request
* Confirm if a certificate/private key and certificate/certificate request (CSR) go together
* Check to confirm if a SSL Certificate has been installed correctly and if it will be trusted in most major browsers

## Installation

Install via composer

```sh
composer require zimosworld/ssltools
```

## Usage

### Methods

Available methods that can be called: 

* decodeCertificate( $certificate )
* decodeCertificateRequest( $certificateRequest )
* matchWithPrivateKey( $privateKey, $certificate )
* matchWithCSR( $certificateRequest, $certificate )
* checkInstalledCertificate( $url )

### Usage Example

Basic usage example using the decodeCertificate method:

```php
$certificate = '-----BEGIN CERTIFICATE-----
....
-----END CERTIFICATE-----';

$sslTools = SSLTools::getInstance();
$result = $sslTools->decodeCertificate( $certificate );

var_dump( $result->getCommonName() );
```

## Running Tests

Installation and Usage commands need to be run from the library root. 

### Installation

1. Run `composer install`

### Usage

1. Run `vendor/bin/phpunit`