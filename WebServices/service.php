<?php

require_once '../lib/nusoap.php';
//require_once 'data,php';

$server = new nusoap_server();

$server->configureWSDL("Soap Demo","urn:soapdemo");//configure WSDL file

$server->register(//register function
    "get_price",//name of function
    array("name"=>"xsd:string"),//inputs
    array("return"=>"xsd:integer")//outputs
);

$server->service(file_get_contents("php://input"));