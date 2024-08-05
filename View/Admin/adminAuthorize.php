<?php
require_once '../../SessionEncryption/SessionEncrypt.php';
require_once '../../SessionEncryption/config.php';
//prevent unauthorized from staff

//session_start();
$sessionEncryption = new SessionEncrypt(SESSION_KEY);
if(isset($_SESSION['role'])){
    $role = $sessionEncryption->decrypt($_SESSION['role']);
}

if(isset($role)){
    if(strcasecmp($role, "Admin") != 0){
        echo '<script>alert("Access Denied");</script>';
        echo '<script>window.location.href = "adminHome.php";</script>';
    }
}else{
     echo '<script>alert("Access Denied");</script>';
     echo '<script>window.location.href = "adminHome.php";</script>';
}

