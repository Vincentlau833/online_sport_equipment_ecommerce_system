<?php
require_once 'DatabaseConnectionManager.php';

class orderDA{
    public function __construct() {
        
    }
    
    public function insertOrder(\Order $order){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $orderStatus = $order->getOrderStatus();
        $custID = $order->getCustID();
        
        $sql = "INSERT INTO custorder(orderStatus,custID) VALUES(?,?)";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ss',$orderStatus,$custID);
        $stmt->execute();
        
        if($stmt->affected_rows > 0){
            return true;
        }else{
            return false;
        }
        
        $con->close();
        $stmt->close();
        
        
    }
    
    public function retrieveOrder(){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT * FROM custorder";
        
        $result = $con->query($sql);
        
       

        return $result;
    }
    
    public function getNumOfRecords(){//generate id
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $sql = "SELECT COUNT(*) AS total_records FROM custOrder";
        
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $total_records = $row['total_records'];
        
        return $total_records;
        
        
    }
    
    public function insertOrderDetails(\OrderDetails $orderDetails){
        $connectionManager = DatabaseConnectionManager::getInstance();
        $con = $connectionManager->getConnection();
        
        $orderID = $orderDetails->getOrderID();
        $productID = $orderDetails->getProductID();
        $productQuantity = $orderDetails->getProductQuantity();
        $orderDate = $orderDetails->getOrderDate();
        $orderTime = $orderDetails->getOrderTime();
        
        $sql = "INSERT INTO orderdetails(orderID,productID,productQuantity,orderDate,orderTime) VALUES(?,?,?,?,?)";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssss',$orderID,$productID,$productQuantity,$orderDate,$orderTime);
        $stmt->execute();
        
        if($stmt->affected_rows > 0){
            return true;
        }else{
            return false;
        }
        
        $con->close();
        $stmt->close();
        
        
        
        
    }
}


