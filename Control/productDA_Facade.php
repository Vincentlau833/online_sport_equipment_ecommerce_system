<?php

require_once 'productDA.php';

class productDA_Facade{
    private $productDA;
    
    public function __construct(){
        $this->productDA = new productDA();
    }
    
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
}

