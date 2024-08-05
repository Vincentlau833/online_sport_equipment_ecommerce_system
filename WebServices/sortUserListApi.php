<?php

require_once '../Control/DAFacade.php';
header("Content-Type:application/json");
//REST

//receieve request
if(!empty($_GET['attribute']) && !empty($_GET['sortType'])){
    $attribute = $_GET['attribute'];
    $sortType = $_GET['sortType'];
    
    $searchResultList = getCustomerListBySort($attribute, $sortType);
    
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


function getCustomerListBySort($attribute,$sortType){
    $DAFacade = new DAFacade();
    $result = $DAFacade->getCustomerBySort($attribute, $sortType);
    
    $index = 0;
    while($row = $result->fetch_object()){
       
        
            //store the product id into the array
            $searchResultList[$index]['custID'] = $row->custID;
            $searchResultList[$index]['userName'] = $row->userName;
            $searchResultList[$index]['email'] = $row->email;
            $searchResultList[$index]['gender'] = $row->gender;
            $searchResultList[$index]['status'] = $row->status;
            $index++;
    }
    return $searchResultList;
}

