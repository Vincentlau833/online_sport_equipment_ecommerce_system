<?php




class test{
    private $con;
    private $stmt;
    
    public function __construct() {
        $this->createConnection();
    }

    
    private function addStud($studentID,$studentName,$gender,$program){
        $sql = 'INSERT INTO customer VALUES(?,?,?,?)';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssss',$studentID,$studentName,$gender,$program);
        $stmt->execute();
        
        if($stmt->affected_rows > 0){
            return true;
        }else{
            return false;
        }
        
        
        $con->close();
        $stmt->close();
    }
    
    
    
    
    
    
    
    private function createConnection(){
        $instance = dbConnection::getInstance();
        $con = $instance->getConnection();
    }
    
   
}

