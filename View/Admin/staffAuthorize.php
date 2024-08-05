<?php
require_once '../../SessionEncryption/SessionEncrypt.php';
require_once '../../SessionEncryption/config.php';

session_start();
$sessionEncryption = new SessionEncrypt(SESSION_KEY);
if(isset($_SESSION['role'])){
    $role = $sessionEncryption->decrypt($_SESSION['role']);
}

if(isset($role)){
    if(strcasecmp($role, "Staff") != 0 && strcasecmp($role, "Admin")){
        echo '<script>alert("Access Denied");</script>';
        echo '<script>window.location.href = "../Customer/home.php";</script>';
    }
}else{
     echo '<script>alert("Access Denied");</script>';
     echo '<script>window.location.href = "../Customer/home.php";</script>';
}
