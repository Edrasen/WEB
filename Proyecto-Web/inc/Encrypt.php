<?php
class Encrypter {
 
    private static $Key = "Yo que se";
 
    public static function encrypt ($input) {
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), $input, MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))));
        return $output;
    }
    //string mcrypt_encrypt ( string $cipher , string $key , string $data , string $mode , string $iv  )
    
    public static function decrypt ($input) {
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))), "\0");
        return $output;
    }
    public static function encryptPSW ( $input, $Key) {
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($Key), $input, MCRYPT_MODE_CBC, md5(md5($Key))));
        return $output;
    }
    //string mcrypt_encrypt ( string $cipher , string $key , string $data , string $mode , string $iv  )
    
    public static function decryptPSW ( $input, $Key) {
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5($Key))), "\0");
        return $output;
    }
 
}?>