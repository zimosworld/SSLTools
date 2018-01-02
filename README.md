SSL Tools
===========================

## What is this?

SSL Tools is a set of tools that allow you to

* Decode PEM encoded certificate and certificate request
* Confirm if a certificate/private key and certificate/certificate request (CSR) go together
* Check to confirm if a SSL Certificate has been installed correctly and if it will be trusted in most major browsers

## Installation

### Via composer

```sh
composer require zimosworld/ssltools
```

## Usage

### List of commands

* decodeCertificate( $certificate )
* decodeCertificateRequest( $certificateRequest )
* matchWithPrivateKey( $privateKey, $certificate )
* matchWithCSR( $certificateRequest, $certificate )
* checkInstalledCertificate( $hostname )

### Examples

Basic examples how to issue a request.

#### Decode Certificate

```php
$certificate = '-----BEGIN CERTIFICATE-----
....
-----END CERTIFICATE-----';

$decode = new SSLTools();
$result = $decode->decodeCertificate( $certificate );

var_dump( $result->getCommonName() );
```

### Decode Certificate Request
```php
$certificateRequest = '-----BEGIN CERTIFICATE REQUEST-----
....
-----END CERTIFICATE REQUEST-----';

$decode = new SSLTools();
$result = $decode->decodeCertificateRequest( $certificateRequest );

var_dump( $result->getCommonName() );
```

#### Match Private Key and Certificate
```php
$certificate = '-----BEGIN CERTIFICATE-----
....
-----END CERTIFICATE-----';

$privateKey = '-----BEGIN PRIVATE KEY-----
....
-----END PRIVATE KEY-----';

$match  = new SSLTools();
$result = $match->matchWithPrivateKey( $privateKey, $certificate );

var_dump( $result->getMatch() );
```

#### Check Installed SSL
```php
$check  = new SSLTools();
$result = $check->checkInstalledCertificate( 'http://google.com' );

var_dump( $certificateChain[0]->toArray() );
```

## Running Tests

Installation and Usage commands need to be run from the git root. 

### Installation

1. Run `composer install`

### Usage

1. Run `vendor/bin/phpunit`