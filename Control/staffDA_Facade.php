<?php

require_once 'staffDA.php';

class staffDA_Facade{
    private $staffDA;
    public function __construct() {
        $this->staffDA = new staffDA();
    }
    
    public function insertStaff(\Staff $staff,$contactNo){
        return $this->staffDA->insertStaff($staff,$contactNo);
    }
    
    public function retrieveStaff($staffID){
        return $this->staffDA->retrieveStaff($staffID);
    }
    
    public function retrieveAllStaffs(){
        return $this->staffDA->retrieveAllStaffs();
    }
    
    public function matchStaff($email,$password){
        return $this->staffDA->matchStaff($email, $password);
    }
    
    public function removeStaff($staffID){
        return $this->staffDA->removeStaff($staffID);
    }
    
    public function changePassword($staffID,$newPassword){
        return $this->staffDA->changePassword($staffID, $newPassword);
    }
    
    public function verifyPassword($staffID,$oldPassword){
        return $this->staffDA->verifyPassword($staffID, $oldPassword);
    }
    
    public function updateStaffInfo($staffID,$staffName,$email,$contactNo,$gender){
        return $this->staffDA->updateProfile($staffID, $staffName, $email, $contactNo,$gender);//update profile = updateStaffInfo
    }
    
    public function validateStaffName($staffName){
        return $this->staffDA->validateStaffName($staffName);
    }
    
    public function validateEmail($email){
        return $this->staffDA->validateEmail($email);
    }
    
    public function validatePassword($password,$confirmPassword){
        return $this->staffDA->validatePassword($password, $confirmPassword);
    }
}

