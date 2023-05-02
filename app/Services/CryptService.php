<?php

namespace App\Services;

use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\RSA;

class CryptService{

    private function getKey(){
        return config('app.momo.encrypt_key');
    }


    public static function Encrypt_data($data, $key)
    {
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return base64_encode(openssl_encrypt(is_array($data) ? json_encode($data) : $data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
    }
    public static function Decrypt_data($data, $key = ""){
        if(!$key) $key = (new CryptService)->getKey();
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return openssl_decrypt(base64_decode($data), 'AES-256-CBC',$key , OPENSSL_RAW_DATA, $iv);
    }
    public static function RSA_Encrypt($content, $rsaPublicKey): string
    {
        if(!$rsaPublicKey) $rsaPublicKey = config('app.momo.public_key');
        $key = PublicKeyLoader::load($rsaPublicKey);
        $key = $key->withPadding(RSA::ENCRYPTION_PKCS1);
        return base64_encode($key->encrypt($content));
    }

}
