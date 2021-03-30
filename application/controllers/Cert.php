<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Cert extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function ca_get(){

        $Configs = array(       
            'digest_alg' => 'sha1',
            'x509_extensions' => 'v3_ca',
            'req_extensions' => 'v3_req',
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
            'encrypt_key' => true,
            'encrypt_key_cipher' => OPENSSL_CIPHER_3DES
        );
        
        //generate cert
        $dn = array(
            "countryName" => "sv",
            "stateOrProvinceName" => "san miguel",
            "localityName" => "san miguel",
            "organizationName" => "datum",
            "organizationalUnitName" => "middleware",
            "commonName" => "test",
            "emailAddress" => "adrian@test.com"
        );
        $privkey   = openssl_pkey_new($Configs);
        $csr       = openssl_csr_new($dn, $privkey, $Configs);
        $cert      = openssl_csr_sign($csr, null, $privkey, 365, $Configs);
        $publicKey = openssl_pkey_get_public($cert);
        // openssl_csr_export($csr, $csrout, false) and var_dump($csrout);
        // openssl_pkey_export($privkey, $pkeyout, "mypassword") and var_dump($pkeyout);
        // var_dump($publicKey);
        openssl_x509_export($cert, $certout, true);
        // openssl_csr_export_to_file($csr, "file.txt");
        // file_put_contents('csrout.txt', $csrout);
        
    }

    

}