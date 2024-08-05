<?php

class Admin extends User{
     public function __construct($userName, $email, $password, $gender) {
        parent::__construct($userName, $email, $password, $gender);
    }

    public function getAddress() {
        return parent::getAddress();
    }

    public function getContactNo() {
        return parent::getContactNo();
    }

    public function getEmail() {
        return parent::getEmail();
    }

    public function getGender() {
        return parent::getGender();
    }

    public function getPassword() {
        return parent::getPassword();
    }

    public function getUserName() {
        return parent::getUserName();
    }

    public function setAddress($address): void {
        parent::setAddress($address);
    }

    public function setContactNo($contactNo): void {
        parent::setContactNo($contactNo);
    }

    public function setEmail($email): void {
        parent::setEmail($email);
    }

    public function setGender($gender): void {
        parent::setGender($gender);
    }

    public function setPassword($password): void {
        parent::setPassword($password);
    }

    public function setUserName($userName): void {
        parent::setUserName($userName);
    }

    public static function pageRedirect() {
        return '<script>window.location.href = "../View/Admin/productList.php";</script>';
    }
    
}
