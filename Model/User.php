<?php

abstract class User{
    protected $userName;
    protected $email;
    protected $password;
    protected $gender;
    protected $contactNo;
    protected $address;
    
    public function __construct($userName, $email, $password, $gender) {
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->gender = $gender;
//        $this->contactNo = $contactNo;
//        $this->address = $address;
    }
    
    
    public function getUserName() {
        return $this->userName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getContactNo() {
        return $this->contactNo;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setUserName($userName): void {
        $this->userName = $userName;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setGender($gender): void {
        $this->gender = $gender;
    }

    public function setContactNo($contactNo): void {
        $this->contactNo = $contactNo;
    }

    public function setAddress($address): void {
        $this->address = $address;
    }

    abstract public static function pageRedirect();

}

