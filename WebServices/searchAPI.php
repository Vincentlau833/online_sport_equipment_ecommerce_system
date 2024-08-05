<?php
require_once '../Control/productDA_Facade.php';
header("Content-Type:application/json");
//REST

//receieve request
if(!empty($_GET['productName'])){
    $productName = $_GET['productName'];
    $searchResultList = searchProduct($productName);
    
    if(empty($searchResultList)){
        response(200,"Product Not Found",NULL);
    }else{
        response(200,"Product Found",$searchResultList);
    }
}else{
    response(200,"Invalid Request",NULL);
}
//response function
function response($status,$status_message,$data){
    header("HTTP/1.1 ".$status);
    
    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;
    
    $json_response = json_encode($response);
    echo $json_response;
}

//retrieve product list from database and perform search function
function searchProduct($productName){//this function return the result array
    $productDAFacade = new productDA_Facade();
    $result = $productDAFacade->retrieveProductList();
    
    $searchProductName = trim($productName);
    
    //$productNameList = array();//array of product list that use to store all the product name
    $searchResultList = array();//array use to store the id for the product match 
    $index = 0;
    while($row = $result->fetch_object()){
        //retrieve product name from the database
        $tempProductName = $row->productName;
        //compare the $productName with the $tempProductName
        if(stripos($tempProductName, $searchProductName)!== false){
            //store the product id into the array
            $searchResultList[$index]['productID'] = $row->productID;
            $searchResultList[$index]['productName'] = $row->productName;
            $searchResultList[$index]['productPrice'] = $row->productPrice;
            $searchResultList[$index]['productDesc'] = $row->productDesc;
            $searchResultList[$index]['stockQuantity'] = $row->stockQuantity;
            $searchResultList[$index]['productImage'] = $row->productImage;
        }
        $index++;
    }
    return $searchResultList;
}

//searchProduct(/*$productName*/);
//print_r(searchProduct("Football"));

