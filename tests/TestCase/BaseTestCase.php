<?php namespace Zimosworld\Tests\TestCase;

use PHPUnit\Framework\TestCase;

/**
 * Class BaseTestCase
 * @package Zimosworld\Tests\TestCase
 */
class BaseTestCase extends TestCase {

	private $certificate = '-----BEGIN CERTIFICATE-----
MIIDZDCCAkwCCQDFapBwlifkjTANBgkqhkiG9w0BAQUFADB0MQswCQYDVQQGEwJB
VTEdMBsGA1UEAxMUc3NsdG9vbHMuc3NsdXRpbC5jb20xDzANBgNVBAcTBlN5ZG5l
eTERMA8GA1UEChMIU1NMIFRlc3QxDDAKBgNVBAgTA05TVzEUMBIGA1UECxMLRGV2
ZWxvcG1lbnQwHhcNMTcxMjMwMDcwMzI2WhcNMTgxMjMwMDcwMzI2WjB0MQswCQYD
VQQGEwJBVTEdMBsGA1UEAxMUc3NsdG9vbHMuc3NsdXRpbC5jb20xDzANBgNVBAcT
BlN5ZG5leTERMA8GA1UEChMIU1NMIFRlc3QxDDAKBgNVBAgTA05TVzEUMBIGA1UE
CxMLRGV2ZWxvcG1lbnQwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDH
Nxjcjcusm5POQa71v4agV2Vc1EXLwuMwHxV8SFauI41SBwHrEeqLgufa/GD+Bm6k
zKuiCdBcb9hpFi91rySMQ4pLPb3QAnsIzwjr6k7WFaQdGzJb00oa1394QTC/JmC+
iDpX1JapE7bxwZLzmB0Y3KqBEiiD0xRRNVbRkIP49VqDJ5Lgd93voYORWCbypCs3
1YKuVja4ODmxc1to79FLddZn9kV4dZp1uNMZVkfJ7fb6wnNRmQOjXSHEiuCSrzGV
MZQSJtaPDpx74pwfZraZiiKdZyN3cgejW26q+ESgVbOSZIMRa+IHwGCDtuoo8B4t
I+hpsACVADi2MVISLX+pAgMBAAEwDQYJKoZIhvcNAQEFBQADggEBAKhtctYgzP0+
TXajl8T/42QNrmnlWTmzwGDue/ac3rT2XYRX8OiCGM3WGggsoJ3Tg7zlk66AQ6ch
6kJaLLaJT9JI0WsHxgrbFMRpNz7QfvPQbmepbEQbt7x8bbIqJdVA3L8uV5XDPEuF
GPgMHc/+XuqSDrARISvKNtVZmhW1QTciyAGo2M+GG7/swJukiWskk7zj6OP8lNp1
kQsGnegxtJzulEG0kxXEhNmV6DjJtj0Dz9ccdCJ8fpxZpZmCXqCbpIW61JJlLLuQ
IOB6oL4TkaZ7HkBA5BTs+S14D1aPsP85LtaB3AYAzynGc60udt+MB9zPQ5B+ykiU
FTuLFyGn1uU=
-----END CERTIFICATE-----';

	private $privateKey = '-----BEGIN PRIVATE KEY-----
MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDHNxjcjcusm5PO
Qa71v4agV2Vc1EXLwuMwHxV8SFauI41SBwHrEeqLgufa/GD+Bm6kzKuiCdBcb9hp
Fi91rySMQ4pLPb3QAnsIzwjr6k7WFaQdGzJb00oa1394QTC/JmC+iDpX1JapE7bx
wZLzmB0Y3KqBEiiD0xRRNVbRkIP49VqDJ5Lgd93voYORWCbypCs31YKuVja4ODmx
c1to79FLddZn9kV4dZp1uNMZVkfJ7fb6wnNRmQOjXSHEiuCSrzGVMZQSJtaPDpx7
4pwfZraZiiKdZyN3cgejW26q+ESgVbOSZIMRa+IHwGCDtuoo8B4tI+hpsACVADi2
MVISLX+pAgMBAAECggEBAJ76bTC1R7C7hzy2VjVvXrReilmGXRy6risc4zyHTgUy
AflP9kvtxEsJcJXlilGuOGXzn5R0WH8sEnvqZH16A6Sb0aUx5GQ3VpA1CF2cYsWe
B5XiulFlUGITT3pcK9affd0PQeANmx3aycgsPmV/ItlQYBEYuJRawn/8HQioV2k4
mT9QQFAXQESJ/6NEh5fmJE0vsDKKVC2KYF99FJD9/UvKmb0wWsV1XGbUuA8taIg0
5IWgiuAyN69eyfPGdbXQMfvIxkMBwFzUJGvVG2jRTQdky/Ij7uHFQh6Wtnv+GJIe
/5NZrDvZacv2mheT3jvqM10JsRZ6CmM8fgLX+VCN2vECgYEA+0khDAGAaH6poWWB
xCuR36oCWyb3pDYM4J+UaM2echdeL8ycnc5xgI/5DktPPnHDSEPa4k6qILFRjhgy
djXy+cOP2+k76+GciUjKMh/kX66nx/cj4v5vSG7Hu51TpFN1tndW5/0C4pZfrHw3
iWPmGBVREqIP4Irseqwa1WmFwGcCgYEAyvPiirTzlI3MLnc8mHtPeshd/BxHEFN1
x3z7fn2zjRa5T1y+qj1em34DII3b2It1KKRvnvLGW5rxtL/xOZu7dJfg815tjZ+y
zFeQcG4mCI68Hm2314TgCILe5gFOJDSPPDLL+lNojxwChDm1gYvsj3cret8+EUo0
eRCKECXAdW8CgYEAiosOOlVVm8dB9SdG/YZcHenY9LKuVI4sWWgCZin/0r2Jg2cX
bnYU5CH82eGxpicI2P34X0+pwu6gnWw/3ibueMBWv5N/IxU3vgUw3aPxwMNF5B0h
XxSS/Gd/nbQnGnGdc+WmN6+qeI0Z4Lp30DsQ8HRIR7KseEuACD59aO6N/L8CgYEA
nOEGtZeITcWKFkTfFzMCTfPCCpZFLE6HVWu775v1BdOR7NHRJEEJ94HhovFlBi9O
odrx2VjqkXbk7YYNTi2eKlMYdKcCYh4XFLN/GBlc1vKWYaMIH9U7Y/jdmcdagswK
CEtvtxFwWmcZXuJI9lmVw5QnjPQxwyWsCAUL4816xosCgYBlEpVP8irxIUx9Qjtl
wM2IbwfLU0qRVA24ou+ehLIBs2ydTY6pL+BcAVvyHr7kO8ynhYwT/ju3/KLNM6gZ
arWhju78jVLNQHB1Zf2dO+uHoVypM60hGcRPYreigKtfeqtyMmAwyBaDrSePsAZH
tDeVcToAvI70tNA5l+SL+yI3Pg==
-----END PRIVATE KEY-----';

	private $certificateRequest = '-----BEGIN CERTIFICATE REQUEST-----
MIICuDCCAaACADB0MQswCQYDVQQGEwJBVTEdMBsGA1UEAxMUc3NsdG9vbHMuc3Ns
dXRpbC5jb20xDzANBgNVBAcTBlN5ZG5leTERMA8GA1UEChMIU1NMIFRlc3QxDDAK
BgNVBAgTA05TVzEUMBIGA1UECxMLRGV2ZWxvcG1lbnQwggEiMA0GCSqGSIb3DQEB
AQUAA4IBDwAwggEKAoIBAQDHNxjcjcusm5POQa71v4agV2Vc1EXLwuMwHxV8SFau
I41SBwHrEeqLgufa/GD+Bm6kzKuiCdBcb9hpFi91rySMQ4pLPb3QAnsIzwjr6k7W
FaQdGzJb00oa1394QTC/JmC+iDpX1JapE7bxwZLzmB0Y3KqBEiiD0xRRNVbRkIP4
9VqDJ5Lgd93voYORWCbypCs31YKuVja4ODmxc1to79FLddZn9kV4dZp1uNMZVkfJ
7fb6wnNRmQOjXSHEiuCSrzGVMZQSJtaPDpx74pwfZraZiiKdZyN3cgejW26q+ESg
VbOSZIMRa+IHwGCDtuoo8B4tI+hpsACVADi2MVISLX+pAgMBAAGgADANBgkqhkiG
9w0BAQsFAAOCAQEALBfscgpoMvv0toid/rPs4TmmtFS3gVjOg2qHwsl+p7MhYG3C
9gO/Zmu8RCqKYJvQRoNGC0yrUHq/wQfuBaOECU93n3dOl0+GYppKOzXTQFE452BL
i6WhgqI58tJyln+m8aFTNhfC8N4XFEkYXk5KowWeEsv9+FcK56kHQ3+N6DY5eVYK
5taBT4sFA34e+fBAnVNBtAEd5GjPISgIf4t0bCExDfEuf8K1FeRzg1339dLSLChP
1s6wrf67OKQeiezUf7Ls3+eSomIIcKek0Dnyvjf+XGvshVkYf0zrlyjq84YpxYP4
nxRIJXjEpHbdYnl2ebmDexlaMzrPFVS1uNDCWA==
-----END CERTIFICATE REQUEST-----';

	/**
	 * @return string
	 */
	public function getCertificate() {
		return $this->certificate;
	}

	/**
	 * @param string $certificate
	 */
	public function setCertificate( $certificate ) {
		$this->certificate = $certificate;
	}

	/**
	 * @return string
	 */
	public function getPrivateKey() {
		return $this->privateKey;
	}

	/**
	 * @param string $privateKey
	 */
	public function setPrivateKey( $privateKey ) {
		$this->privateKey = $privateKey;
	}

	/**
	 * @return string
	 */
	public function getCertificateRequest() {
		return $this->certificateRequest;
	}

	/**
	 * @param string $certificateRequest
	 */
	public function setCertificateRequest( $certificateRequest ) {
		$this->certificateRequest = $certificateRequest;
	}

}
