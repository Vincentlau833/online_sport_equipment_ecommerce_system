<?php
require_once 'DatabaseConnectionManager.php';

class staffDA{
    public function __construct(){
        
    }
    
    public function insertStaff(\Staff $staff,$contactNo){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        //$con
        $staffName = $staff->getUserName();
        $email = $staff->getEmail();
        $password = $staff->getPassword();
        $gender = $staff->getGender();
        //$userName = $customer->getUserName();
        
        $sql = "INSERT INTO staff(staffName,email,password,gender,contactNo) VALUES (?,?,?,?,?)";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssss',$staffName,$email,$password,$gender,$contactNo);
        $stmt->execute();
        
        if($stmt->affected_rows > 0){
            return true;
        }else{
            return false;
        }
        
        $con->close();
        $stmt->close();
        
    }
    
    public function retrieveStaff($id){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM staff WHERE staffId = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$id);
        
        $stmt->execute();
        
        $result = $stmt->get_result();

        return $result;
    }
    
    public function retrieveStaffByEmail($email){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM staff WHERE email = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$email);
        
        $stmt->execute();
        
        $result = $stmt->get_result();

        return $result;
    }
    
    public function retrieveAllStaffs(){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM staff";
        
        $result = $con->query($sql);
        
        return $result;
    }
    
    public function matchStaff($email,$password){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM staff";
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
    
    public function updateProfile($staffID,$staffName,$email,$contactNo,$gender){
//        $userName = $customer->getUserName();
//        $email = $customer->getEmail();
//        //$gender = $customer->getGender();
//        $contactNo = $customer->getContactNo();
//        //$address = $customer->getAddress();
        
        
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "UPDATE staff SET staffName = ?,email = ?,contactNo = ?, gender = ? WHERE staffID = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssss",$staffName,$email,$contactNo,$gender,$staffID);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        
        
    }
    
    public function removeStaff($staffID){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "DELETE FROM staff WHERE staffID = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$staffID);
        $stmt->execute();
        
        if($stmt->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function changePassword($staffID,$newPassword){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "UPDATE staff set password = ? WHERE staffID = ?";
        
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss",$newPassword,$staffID);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        
        
    }
    
    public function verifyPassword($staffID,$oldPassword){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM staff WHERE staffID = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$staffID);
        
        $stmt->execute();
        
        $result = $stmt->get_result();

        $match = false;
        if($row = $result->fetch_object()){
            $hashed_password = $row->password;
            if(password_verify($oldPassword, $hashed_password)){
                $match = true;
            }
            
        }
        
        return $match;
        
    }
    
    public function getStaffBySort($attribute,$sortType){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        //$sortType = ASC || DESC
        $sql = "SELECT * FROM staff ORDER BY " . $attribute . " " . $sortType;//attribute and sort type

        $stmt = $con->prepare($sql);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }    
//    public function updateAddress($staffID,\Address $address){
//        $addLine1 = $address->getAddressLine1();
//        $addLine2 = $address->getAddressLine2();
//        $postcode = $address->getPostcode();
//        $city = $address->getCity();
//        $state = $address->getState();
//        $country = $address->getCountry();
//        
//        $connectionManager = DatabaseConnectionManager::getInstance();
//        $con = $connectionManager->getConnection();
//        
//        $sql = "UPDATE staff SET addLine1 = ?,addLine2 = ?,postcode = ?,city = ?,state = ?,country = ? WHERE staffID = ?";
//        
//        $stmt = $con->prepare($sql);
//        $stmt->bind_param("sssssss",$addLine1,$addLine2,$postcode,$city,$state,$country,$custID);
//        
//        if($stmt->execute()){
//            return true;
//        }else{
//            return false;
//        }
//        
//        
//        
//    }
    
//    public function retrieveAddress($staffID){
//        $connectionManager = DatabaseConnectionManager::getInstance();
//        $con = $connectionManager->getConnection();
//        
//        $sql = "SELECT * FROM staff WHERE staffID = ?";
//        
//        $stmt = $con->prepare($sql);
//        $stmt->bind_param("s",$staffID);
//        
//        $stmt->execute();
//        
//        $result = $stmt->get_result();
//
//        if($row = $result->fetch_object()){
//            $addLine1 = $row->addLine1;
//            $addLine2 = $row->addLine2;
//            $postcode = $row->postcode;
//            $city = $row->city;
//            $state = $row->state;
//            $country = $row->country;
//            
//            $address = new Address($addLine1,$addLine2,$postcode,$city,$state,$country);
//            
//        }
//        
//        return $address;
//        
//        
//    }
    
    public function validateStaffName($staffName){
        if($staffName == null){
            return "*Staff name field cannot be empty.";
        }else if(strlen($staffName)> 20){
            return "*Staff name should not be more than 20 characters.";
        }else if(!preg_match('/^[A-Za-z0-9 ]+$/',$staffName)){
            return "*Invalid characters detected in the staff name entered.";
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
    
//    public function validateAddressLine($addressLine){
//        if($addressLine == null){
//            return "*The address field cannot be empty";
//        }else if(strlen($addressLine) > 50){
//            return "*The address field cannot be more than 50 words";
//        }else if(!preg_match('/^[A-Za-z0-9 ]+$/',$addressLine)){
//            return "*Invalid characters detected in the address field";
//        }else{
//            return null;
//        }
//    }
//    
//    public function validatePostcode($postcode){
//        if($postcode == null){
//            return "*The postcode field cannot be empty";
//        }else if(strlen($postcode) != 5 ){
//            return "*Postcode must be consists of 5 characters."; 
//        }else if(!preg_match('/^\d+$/',$postcode)){
//            return "*Postcode should only consists of numbers(eg:14000)";
//        }else{
//            null;
//        }
//    }
//    
//    public function validateCity($city){
//        if($city == null){
//            return "*The city field cannot be empty";
//        }else if(strlen($city) > 30){
//            return "*The length of the city should not be more than 30 characters.";
//        }else if(!preg_match('/^[A-Za-z ]+$/',$city)){
//            return "*Invalid characters detected in the city field";
//        }else{
//            return null;
//        }
//    }
//    
//    public function validateState($state){
//        if($state == null){
//            return "*State must be selected.";
//        }else{
//            return null;
//        }
//    }
    
    
    
    
}




