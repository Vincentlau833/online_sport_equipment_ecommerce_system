<?php

class Order{
    
    private $OrderStatus;
    private $custID;
    
    public function __construct($OrderStatus, $custID) {
        $this->OrderStatus = $OrderStatus;
        $this->custID = $custID;
    }
    

    public function getOrderStatus() {
        return $this->OrderStatus;
    }

    public function getCustID() {
        return $this->custID;
    }

 

    public function setOrderStatus($OrderStatus): void {
        $this->OrderStatus = $OrderStatus;
    }

    public function setCustID($custID): void {
        $this->custID = $custID;
    }



    
}
