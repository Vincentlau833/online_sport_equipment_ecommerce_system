<?php

require_once '../Control/DAFacade.php';
header("Content-Type:application/json");
//REST

//receieve request
if(!empty($_GET['attribute']) && !empty($_GET['sortType'])){
    $attribute = $_GET['attribute'];
    $sortType = $_GET['sortType'];
    
    $searchResultList = getStaffListBySort($attribute, $sortType);
    
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


function getStaffListBySort($attribute,$sortType){
    $DAFacade = new DAFacade();
    $result = $DAFacade->getStaffListBySort($attribute, $sortType);
    
    $index = 0;
    while($row = $result->fetch_object()){
       
        
            //store the product id into the array
            $searchResultList[$index]['staffID'] = $row->staffID;
            $searchResultList[$index]['staffName'] = $row->staffName;
            $searchResultList[$index]['email'] = $row->email;
            $searchResultList[$index]['gender'] = $row->gender;
            $searchResultList[$index]['contactNo'] = $row->contactNo;
            $index++;
    }
    return $searchResultList;
}

