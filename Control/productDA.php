<?php

//include '../Model/Product.php';
require_once 'DatabaseConnectionManager.php';

class ProductDA{
    
    public function insertProduct(\Product $product){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        //$con
        $productName = $product->getProductName();
        $productPrice = $product->getProductPrice();
        $productDesc = $product->getProductDesc();
        $stockQuantity = $product->getStockQuantity();
        $productImage = $product->getProductImage();//get path
        
        $sql = "INSERT INTO product(productName,productPrice,productDesc,stockQuantity,productImage) VALUES (?,?,?,?,?)";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssds',$productName,$productPrice,$productDesc,$stockQuantity,$productImage);
        $stmt->execute();
        
                
        if($stmt->affected_rows > 0){
            return true;
        }else{
            return false;
        }
        
        $con->close();
        $stmt->close();
                
    }
    
    public function editProduct($productID,\Product $product){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $productName = $product->getProductName();
        $productPrice = (double)$product->getProductPrice();
        $productDesc = $product->getProductDesc();
        $stockQuantity = (int)$product->getStockQuantity();
        
        $sql = "UPDATE product SET productName=?,productPrice=?,productDesc=?,stockQuantity=? WHERE productid=?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sdsds",$productName,$productPrice,$productDesc,$stockQuantity,$productID);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    public function retrieveProductList(){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM product";
        
        $result = $con->query($sql);
        
        return $result;
    }
    
    public function retrieveProduct($productID){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM product WHERE productID = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$productID);
        
        $stmt->execute();
        
        $result = $stmt->get_result();

        return $result;


        
        
    }
    
    public function deleteProduct($productID){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "DELETE FROM product WHERE productID = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s",$productID);
        $stmt->execute();
        
        if($stmt->affected_rows > 0){
            return true;
        }else{
            return false;
        }
        
        
        
    }
    
    public function checkProductExist($cartList,$productID){
      
        $exist = false;
        if(isset($cartList)){
            for($i=0;$i< count($cartList);$i++){
                if($cartList[$i] == $productID){
                    $exist = true;
                    break;
                }else{
                    $exist = false;
                }
            }
        }
        
        return $exist;
        
    }
    
    public function validateProductName($productName){
        if($productName == null){
            return "*The name of the product field cannot be empty.";
        }else if(strlen($productName)> 20){
            return "*The name of the product should not be more than 20 characters.";
        }else if(!preg_match('/^[A-Za-z0-9 ]+$/',$productName)){
            return "*Invalid characters detected in the product name entered.";
        }else{
            return null;
        }
    }
    
    public function validateProductPrice($productPrice){
        if($productPrice == null){
            return "*The product price field cannot be empty.";
        }else if(!preg_match('/^\d+(?:\.\d{1,2})?$/', $productPrice)){
            return "*Invalid characters detected in the product price entered.";
        }else{
            return null;
        }
    }
    
    public function validateProductDesc($productDesc){
        if($productDesc == null){
            return "*The description of the product field cannot be empty.";
        }else if(strlen($productDesc)> 150){
            return "*The description of the product should not be more than 20 characters.";
        }else{
            return null;
        }
    }
    
    public function validateStockQuantity($stockQuantity){
        if($stockQuantity == null){
            return "*The quantity field cannot be empty.";
        }else{
            return null;
        }
    }
    
    public function validateProductImage($fileType,$fileSize){
        $valid_types = array("image/jpeg","image/png","image/gif");//state all the valid type image
        $max_size = 5 * 1024 * 1024;//5MB
        
        if(!in_array($fileType,$valid_types)){
            return "Invalid file type of the image uploaded";
        }else if($fileSize > $max_size){
            return "Image uploaded cannot be larger than 5MB.";
        }else{
            return null;
        }
    }
    
    public function getProductListBySort($attribute,$sortType){//return the sorted product list
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        //$sortType = ASC || DESC
        $sql = "SELECT * FROM product ORDER BY " . $attribute . " " . $sortType;//attribute and sort type
        
        $stmt = $con->prepare($sql);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
        
    }
    
}