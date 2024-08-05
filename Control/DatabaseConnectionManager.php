<?php
//singleton connect database
class DatabaseConnectionManager{
    private static $instance;
    private $connection;
    
    private function __construct(){
        //private constructor prevent instantiation
    }
    
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new DatabaseConnectionManager();
        }
        return self::$instance;
    }
    
    public function getConnection(){
        if($this->connection == null){
            //create a new database connection
            $host = "localhost";
            $dbname = "sweatlab";
            $username = "root";
            $password = "";
            
            try{
                $this->connection = new mysqli($host,$username,$password,$dbname);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
        
        return $this->connection;
    }
    
}
