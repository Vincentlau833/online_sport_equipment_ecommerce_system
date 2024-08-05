<?php

require_once '../../Model/Customer.php';

class CustomerSAXParser extends XMLReader{
    private $data = array();
    
    public function __construct($filename){
        parent::__construct();
        $this->open($filename);
    }
    
    public function getData(){
        return $this->data;
    }
    
    public function parse(){
        while($this->read()){
            if($this->nodeType == XMLReader::ELEMENT){
                $name = $this->name;
                $node = new Customer();
                
                if($this->hasAttributes){
                    while($this->moveToNextAttribute()){
                        $node->{$this->name} = $this->value;
                    }
                }
                $this->data[] = $node;
            }else if($this->nodeType == XMLReader::TEXT || $this->nodeType == XMLReader::CDATA){
                if(!empty(trim($this->value))){
                    $this->data[count($this->data)-1]->text = trim($this->value);
                }
            }
        }
    }
    
}