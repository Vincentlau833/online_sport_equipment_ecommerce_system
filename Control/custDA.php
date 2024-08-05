<?php
//include '../Model/Customer.php';
require_once 'DatabaseConnectionManager.php';
//require_once '../DesignPatterns/connection.php';




class custDA{
    public function __construct() {
        
    }

    public function insertCust(\Customer $customer){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        //$con
        $userName = $customer->getUserName();
        $email = $customer->getEmail();
        $password = $customer->getPassword();
        $gender = $customer->getGender();
        $status = $customer->getStatus();
        //$userName = $customer->getUserName();
        
        $sql = "INSERT INTO customer(userName,email,password,gender,status) VALUES (?,?,?,?,?)";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssss',$userName,$email,$password,$gender,$status);
        $stmt->execute();
        
        if($stmt->affected_rows > 0){
            return true;
        }else{
            return false;
        }
        
        $con->close();
        $stmt->close();
        
    }
    
    public function retrieveUser($email){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM customer WHERE email = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$email);
        
        $stmt->execute();
        
        $result = $stmt->get_result();

        return $result;


    }
    
    public function retrieveAllUser(){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM customer";
        
        $result = $con->query($sql);
        
        return $result;
    }
        
    
    public function matchUser($email,$password){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM customer";
        //$result = $con->query($sql);
        
        $match = false;
        
        if ($result = $con->query($sql)) {
            while($row = $result->fetch_object()) {
//                echo $row['column1'] . " " . $row['column2'] . "<br>";
                
                $tempEmail = $row->email;
                $tempPwd = $row->password;
              
                if(strcmp($email,$tempEmail) == 0 && password_verify($password, $tempPwd)){
                    $match = true;
                    break;
                }
            }
        }
        
        return $match;
        
        
        
    }
    
    public function updateProfile($custID,$userName,$email,$contactNo){
//        $userName = $customer->getUserName();
//        $email = $customer->getEmail();
//        //$gender = $customer->getGender();
//        $contactNo = $customer->getContactNo();
//        //$address = $customer->getAddress();
        
        
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "UPDATE customer SET userName = ?,email = ?,contactNo = ? WHERE custID = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss",$userName,$email,$contactNo,$custID);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        
        
    }
    
    public function updateAddress($custID,\Address $address){
        $addLine1 = $address->getAddressLine1();
        $addLine2 = $address->getAddressLine2();
        $postcode = $address->getPostcode();
        $city = $address->getCity();
        $state = $address->getState();
        $country = $address->getCountry();
        
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "UPDATE customer SET addLine1 = ?,addLine2 = ?,postcode = ?,city = ?,state = ?,country = ? WHERE custID = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssss",$addLine1,$addLine2,$postcode,$city,$state,$country,$custID);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function ban($custID){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $status = "Banned";
        
        $sql = "UPDATE customer SET status = ? WHERE custID = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss",$status,$custID);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    public function activate($custID){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $status = "Active";
        
        $sql = "UPDATE customer SET status = ? WHERE custID = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss",$status,$custID);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    public function getCustomerBySort($attribute,$sortType){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        //$sortType = ASC || DESC
        $sql = "SELECT * FROM customer ORDER BY " . $attribute . " " . $sortType;//attribute and sort type
        
        $stmt = $con->prepare($sql);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
    
    public function retrieveAddress($custID){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM customer WHERE custID = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$custID);
        
        $stmt->execute();
        
        $result = $stmt->get_result();

        if($row = $result->fetch_object()){
            $addLine1 = $row->addLine1;
            $addLine2 = $row->addLine2;
            $postcode = $row->postcode;
            $city = $row->city;
            $state = $row->state;
            $country = $row->country;
            
            $address = new Address($addLine1,$addLine2,$postcode,$city,$state,$country);
            
        }
        
        return $address;
        
        
    }
    
    
    
    public function validateUsername($userName){
        if($userName == null){
            return "*Username field cannot be empty.";
        }else if(strlen($userName)> 20){
            return "*Username should not be more than 20 characters.";
        }else if(!preg_match('/^[A-Za-z0-9 ]+$/',$userName)){
            return "*Invalid characters detected in the username entered.";
        }else{
            return null;
        }

    }
    
    public function validateEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return null;
        } else {
            return "*Invalid email address.";
        }
    }
    
    
    
    public function validatePassword($password,$confirmPassword){
        if($password == null || $confirmPassword == null){
            return "*Password field cannot be empty.";
        }else if(strlen($password) < 6){
            return "*Password must be at least consists of 6 characters.";
        }else if(strcmp($password,$confirmPassword) != 0){
            return "*Password does not match.";
        }else{
            return null;
        }
    }
    
    public function validateAddressLine($addressLine){
        if($addressLine == null){
            return "*The address field cannot be empty";
        }else if(strlen($addressLine) > 50){
            return "*The address field cannot be more than 50 words";
        }else if(!preg_match('/^[A-Za-z0-9 ]+$/',$addressLine)){
            return "*Invalid characters detected in the address field";
        }else{
            return null;
        }
    }
    
    public function validatePostcode($postcode){
        if($postcode == null){
            return "*The postcode field cannot be empty";
        }else if(strlen($postcode) != 5 ){
            return "*Postcode must be consists of 5 characters."; 
        }else if(!preg_match('/^\d+$/',$postcode)){
            return "*Postcode should only consists of numbers(eg:14000)";
        }else{
            null;
        }
    }
    
    public function validateCity($city){
        if($city == null){
            return "*The city field cannot be empty";
        }else if(strlen($city) > 30){
            return "*The length of the city should not be more than 30 characters.";
        }else if(!preg_match('/^[A-Za-z ]+$/',$city)){
            return "*Invalid characters detected in the city field";
        }else{
            return null;
        }
    }
    
    public function validateState($state){
        if($state == null){
            return "*State must be selected.";
        }else{
            return null;
        }
    }
    
    public function validateContactNo($contactNo){
        $pattern = '/^(?:\+?6?01)[0-9]{8}$/';
        if($contactNo == null){
            return "Contact number cannot be empty.";
        }else if(!preg_match($pattern,$contactNo)){
            return "Invalid characters detected in the contact number";
        }else{
            return null;
        }
    }
    
    public function checkEmailRedundant($email){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = 'SELECT * FROM customer WHERE email = ?';
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$email);
        
        $stmt->execute();
        
        $result = $stmt->get_result();

        $i = 0;
        while($row=$result->fetch_object()){
            $i++;
        }
        
        if($i == 0){
            $match = false;//no match
        }else{
            $match = true;//match
        }
        
        return $match;
    }
    
    
    
   
}

//facade






