<?php

//combine all the DA into one facade
require_once 'custDA.php';
require_once 'productDA.php';
require_once 'staffDA.php';
require_once 'orderDA.php';
require_once 'paymentDA.php';

class DAFacade{
    private $custDA;
    private $productDA;
    private $staffDA;
    private $orderDA;
    private $paymentDA;
    
    public function __construct(){
        $this->custDA = new custDA();
        $this->productDA = new productDA();
        $this->staffDA = new staffDA();
        $this->orderDA = new orderDA();
        $this->paymentDA = new paymentDA();
    }
    //custDA
    //register
    public function register(\Customer $customer){
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
    
    public function getCustomerBySort($attribute,$sortType){
        return $this->custDA->getCustomerBySort($attribute, $sortType);
    }
    
    public function checkEmailRedundant($email){
        return $this->custDA->checkEmailRedundant($email);
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
    
    public function validateContactNo($contactNo){
        return $this->custDA->validateContactNo($contactNo);
    }
    
    //productDA
    public function insertProduct(\Product $product){
        return $this->productDA->insertProduct($product);
    }
    
    public function editProduct($productID,\Product $product){
        return $this->productDA->editProduct($productID, $product);
    }
    
    public function retrieveProductList(){
        return $this->productDA->retrieveProductList();
    }
    
    public function retrieveProduct($productID){
        return $this->productDA->retrieveProduct($productID);
    }
    
    public function deleteProduct($productID){
        return $this->productDA->deleteProduct($productID);
    }
    
    public function checkProductExist($cartList,$productID){
        return $this->productDA->checkProductExist($cartList, $productID);
    }
    
    public function getProductListBySort($attribute,$sortType){
        return $this->productDA->getProductListBySort($attribute, $sortType);
    }
    
    //validation 
    public function validateProductName($productName){
        return $this->productDA->validateProductName($productName);
    }
    
    public function validateProductPrice($productPrice){
        return $this->productDA->validateProductPrice($productPrice);
    }
    
    public function validateProductDesc($productDesc){
        return $this->productDA->validateProductDesc($productDesc);
    }
    
    public function validateStockQuantity($stockQuantity){
        return $this->productDA->validateStockQuantity($stockQuantity);
    }
    
    public function validateProductImage($fileType,$fileSize){
        return $this->productDA->validateProductImage($fileType, $fileSize);
    }
    
    //staffDA
    public function insertStaff(\Staff $staff,$contactNo){
        return $this->staffDA->insertStaff($staff,$contactNo);
    }
    
    public function retrieveStaff($staffID){
        return $this->staffDA->retrieveStaff($staffID);
    }
    
    public function retrieveStaffByEmail($email){
        return $this->staffDA->retrieveStaffByEmail($email);
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
    
    public function getStaffListBySort($attribute,$sortType){
        return $this->staffDA->getStaffBySort($attribute, $sortType);
    }
    
    public function validateStaffName($staffName){
        return $this->staffDA->validateStaffName($staffName);
    }
    
    public function validateStaffEmail($email){
        return $this->staffDA->validateEmail($email);
    }
    
    public function validateStaffPassword($password,$confirmPassword){
        return $this->staffDA->validatePassword($password, $confirmPassword);
    }
    
    //orderDA
    public function retrieveOrder(){
        return $this->orderDA->retrieveOrder();
    }
    
    public function insertOrder(\Order $order){
        return $this->orderDA->insertOrder($order);
    }
    
    public function getNumOfRecords(){
        return $this->orderDA->getNumOfRecords();//generate id
    }
    
    public function insertOrderDetails(\OrderDetails $orderDetails){
        return $this->orderDA->insertOrderDetails($orderDetails);
    }
    
    //paymentDA
    public function insertPayment(\Payment $payment){
        return $this->paymentDA->addPayment($payment);
    }
    public function retrievePaymentRecords(){
        return $this->paymentDA->retrievePaymentRecords();
    }
    
    
    
}

