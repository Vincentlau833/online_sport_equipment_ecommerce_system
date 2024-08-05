<?php

require_once '../../SessionEncryption/SessionEncrypt.php';
require_once '../../SessionEncryption/config.php';

session_start();
$sessionEncryption = new SessionEncrypt(SESSION_KEY);

if(isset($_SESSION['role'])){
    $role = $sessionEncryption->decrypt($_SESSION['role']);
}

if(isset($role)){
    if(strcasecmp($role, "Customer") != 0){
        echo '<script>alert("Please login your account first.");</script>';
        echo '<script>window.location.href = "../login.php";</script>';
    }
}else{
     echo '<script>alert("Please login your account first.");</script>';
     echo '<script>window.location.href = "../login.php";</script>';
}