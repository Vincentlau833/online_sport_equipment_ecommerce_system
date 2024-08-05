<?php

class Payment{
    private $PaymentID;
    private $PaymentAmount;
    private $PaymentMethod;
    private $PaymentDate;
    private $PaymentTime;
    private $orderID;
    
    public function __construct($PaymentAmount, $PaymentMethod, $PaymentDate, $PaymentTime, $orderID) {
        $this->PaymentAmount = $PaymentAmount;
        $this->PaymentMethod = $PaymentMethod;
        $this->PaymentDate = $PaymentDate;
        $this->PaymentTime = $PaymentTime;
        $this->orderID = $orderID;
    }
    
    public function getPaymentID() {
        return $this->PaymentID;
    }

    public function getPaymentAmount() {
        return $this->PaymentAmount;
    }

    public function getPaymentMethod() {
        return $this->PaymentMethod;
    }

    public function getPaymentDate() {
        return $this->PaymentDate;
    }

    public function getPaymentTime() {
        return $this->PaymentTime;
    }

    public function getOrderID() {
        return $this->orderID;
    }

    public function setPaymentID($PaymentID): void {
        $this->PaymentID = $PaymentID;
    }

    public function setPaymentAmount($PaymentAmount): void {
        $this->PaymentAmount = $PaymentAmount;
    }

    public function setPaymentMethod($PaymentMethod): void {
        $this->PaymentMethod = $PaymentMethod;
    }

    public function setPaymentDate($PaymentDate): void {
        $this->PaymentDate = $PaymentDate;
    }

    public function setPaymentTime($PaymentTime): void {
        $this->PaymentTime = $PaymentTime;
    }

    public function setOrderID($orderID): void {
        $this->orderID = $orderID;
    }
}
