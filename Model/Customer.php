<?php
require_once 'Address.php';
require_once 'User.php';



class Customer extends User{
    private $status;
    
    public function __construct($userName, $email, $password, $gender,$status) {
        parent::__construct($userName, $email, $password, $gender);
        $this->status = $status;
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
        return '<script>window.location.href = "../View/Customer/home.php";</script>';
    }
    
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }




//    private $userName;
//    private $email;
//    private $password;
//    private $gender;
//    private $contactNo;
//    private $address;
//    
//    public function __construct($userName, $email, $password, $gender/*, $contactNo*/) {
//        $this->userName = $userName;
//        $this->email = $email;
//        $this->password = $password;
//        $this->gender = $gender;
//        //$this->contactNo = $contactNo;
//    }
//    
//    public function getUserName() {
//        return $this->userName;
//    }
//
//    public function getEmail() {
//        return $this->email;
//    }
//
//
//    public function getGender() {
//        return $this->gender;
//    }
//    
//    public function getPassword() {
//        return $this->password;
//    }
//
//    public function getContactNo() {
//        return $this->contactNo;
//    }
//
//    public function getAddress(): Address {
//        return $this->address;
//    }
//
//    public function setUserName($userName): void {
//        $this->userName = $userName;
//    }
//
//    public function setEmail($email): void {
//        $this->email = $email;
//    }
//
//    public function setPassword($password): void {
//        $this->password = $password;
//    }
//
//    public function setGender($gender): void {
//        $this->gender = $gender;
//    }
//
//    public function setContactNo($contactNo): void {
//        $this->contactNo = $contactNo;
//    }
//
//    public function setAddress(Address $address): void {
//        $this->address = $address;
//    }
//    


    
    





    
}

