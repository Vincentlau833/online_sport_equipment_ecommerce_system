<?php
//facade
require_once 'custDA.php';

class custDA_Facade{
    private $custDA;//class
    
    public function __construct() {
        $this->custDA = new custDA();
    }
    
    public function register(\Customer $customer){ //insert cust in custDA class
         return $this->custDA->insertCust($customer);
    }
    
    public function retrieveUser($email){
        return $this->custDA->retrieveUser($email);
    }
    
    public function retrieveAllUser(){
        return $this->custDA->retrieveAllUser();
    }
    
    public function matchUser($email,$password){
        return $this->custDA->matchUser($email, $password);
    }
    
    //update information
    public function updateProfile($custID,$userName,$email,$contactNo){
        return $this->custDA->updateProfile($custID, $userName, $email, $contactNo);
    }
    
    public function updateAddress($custID,\Address $address){
        return $this->custDA->updateAddress($custID, $address);
    }
    
    public function ban($custID){
        return $this->custDA->ban($custID);
    }
    
    public function activate($custID){
        return $this->custDA->activate($custID);
    }
    
    public function retrieveAddress($custID){
        return $this->custDA->retrieveAddress($custID);
    }
    
    //validation
    public function validateUsername($userName){
        return $this->custDA->validateUsername($userName);
    }
    
    public function validateEmail($email){
        return $this->custDA->validateEmail($email);
    }
    
    public function validatePassword($password,$confirmPassword){
        return $this->custDA->validatePassword($password,$confirmPassword);
    }
    
    public function validateAddressLine($addressLine){
        return $this->custDA->validateAddressLine($addressLine);
    }
    
    public function validatePostcode($postcode){
        return $this->custDA->validatePostcode($postcode);
    }
    
    public function validateCity($city){
        return $this->custDA->validateCity($city);
    }
    
    public function validateState($state){
        return $this->custDA->validateState($state);
    }
}