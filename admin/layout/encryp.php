<?php

if (!function_exists('encryptId')) { //biar Gk error "Cannot redeclare" kalo file yang berisi fungsi ini di-include lebih dari sekali.
    function encryptId($id, $secretKey)
    {
        $method = 'AES-256-CBC';
        $iv = random_bytes(16);
        $encrypted = openssl_encrypt($id, $method, $secretKey, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encrypted);
    }
}

if (!function_exists('decryptId')) { //biar Gk error "Cannot redeclare" kalo file yang berisi fungsi ini di-include lebih dari sekali.
    function decryptId($encryptedData, $secretKey)
    {
        $method = 'AES-256-CBC';
        $data = base64_decode($encryptedData);
        $iv = substr($data, 0, 16);
        $encrypted = substr($data, 16);
        return openssl_decrypt($encrypted, $method, $secretKey, OPENSSL_RAW_DATA, $iv);
    }
}

$key = 'hfkhdfkkjdfkf';
