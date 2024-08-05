<?php

class Product{
    private $ProductName;
    private $ProductDesc;
    private $ProductPrice;
    private $StockQuantity;
    private $productImage;//string
    
    public function __construct($ProductName, $ProductDesc, $ProductPrice, $StockQuantity,$productImage) {
        $this->ProductName = $ProductName;
        $this->ProductDesc = $ProductDesc;
        $this->ProductPrice = $ProductPrice;
        $this->StockQuantity = $StockQuantity;
        $this->productImage = $productImage;
    }
    
    public function getProductName() {
        return $this->ProductName;
    }

    public function getProductDesc() {
        return $this->ProductDesc;
    }

    public function getProductPrice() {
        return $this->ProductPrice;
    }

    public function getStockQuantity() {
        return $this->StockQuantity;
    }

    public function setProductName($ProductName): void {
        $this->ProductName = $ProductName;
    }

    public function setProductDesc($ProductDesc): void {
        $this->ProductDesc = $ProductDesc;
    }

    public function setProductPrice($ProductPrice): void {
        $this->ProductPrice = $ProductPrice;
    }

    public function setStockQuantity($StockQuantity): void {
        $this->StockQuantity = $StockQuantity;
    }
    public function getProductImage() {
        return $this->productImage;
    }

    public function setProductImage($productImage): void {
        $this->productImage = $productImage;
    }




    
}

