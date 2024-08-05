<?php

class OrderDetails{
    private $OrderID;
    private $ProductID;
    private $ProductQuantity;
    private $OrderDate;
    private $OrderTime;
    
    public function __construct($OrderID, $ProductID, $ProductQuantity, $OrderDate, $OrderTime) {
        $this->OrderID = $OrderID;
        $this->ProductID = $ProductID;
        $this->ProductQuantity = $ProductQuantity;
        $this->OrderDate = $OrderDate;
        $this->OrderTime = $OrderTime;
    }
    
    public function getOrderID() {
        return $this->OrderID;
    }

    public function getProductID() {
        return $this->ProductID;
    }

    public function getProductQuantity() {
        return $this->ProductQuantity;
    }

    public function getOrderDate() {
        return $this->OrderDate;
    }

    public function getOrderTime() {
        return $this->OrderTime;
    }

    public function setOrderID($OrderID): void {
        $this->OrderID = $OrderID;
    }

    public function setProductID($ProductID): void {
        $this->ProductID = $ProductID;
    }

    public function setProductQuantity($ProductQuantity): void {
        $this->ProductQuantity = $ProductQuantity;
    }

    public function setOrderDate($OrderDate): void {
        $this->OrderDate = $OrderDate;
    }

    public function setOrderTime($OrderTime): void {
        $this->OrderTime = $OrderTime;
    }
}
