<?php
require_once 'config.php';
class SessionEncrypt{
    private $key;
    
    public function __construct($key) {
        $this->key = $key;
    }
    
    public function encrypt($data){
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc',$this->key,0,$iv);
        return base64_encode($encrypted.'::'.$iv);
    }
    
    public function decrypt($data){
        list($encrypted,$iv) = explode('::', base64_decode($data),2);
        return openssl_decrypt($encrypted, 'aes-256-cbc', $this->key, 0, $iv);
    }
    
}



//session_start();
//
//$sessionEncrypt = new SessionEncrypt(SESSION_KEY);
//
//$_SESSION['password'] = $sessionEncrypt->encrypt('abc1234');
//
//$password = $sessionEncrypt->decrypt($_SESSION['password']);
//
//echo $_SESSION['password'];
