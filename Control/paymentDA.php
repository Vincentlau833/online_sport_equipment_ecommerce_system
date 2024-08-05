<?php
require_once 'DatabaseConnectionManager.php';

class paymentDA{
    public function __construct(){
        
    }
    
    public function addPayment(\Payment $payment){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $paymentAmount = $payment->getPaymentAmount();
        $paymentMethod = $payment->getPaymentMethod();
        $paymentDate = $payment->getPaymentDate();
        $paymentTime = $payment->getPaymentTime();
        $orderID = $payment->getOrderID();
        
        $sql = "INSERT INTO payment(paymentAmount,paymentMethod,paymentDate,paymentTime,orderID) VALUES (?,?,?,?,?)";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param('dssss',$paymentAmount,$paymentMethod,$paymentDate,$paymentTime,$orderID);
        $stmt->execute();
        
        if($stmt->affected_rows > 0){
            return true;
        }else{
            return false;
        }
        
        $con->close();
        $stmt->close();
        
        
    }
    
    public function retrievePaymentRecords(){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM payment";
        
        $result = $con->query($sql);
        
        return $result;
    }
}

