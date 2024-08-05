<?php

require_once '../Control/custDA_Facade.php';
header("Content-Type:application/json");

if(!empty($_GET['userName'])){
    $userName = $_GET['userName'];
    $searchResultList = searchUser($userName);
    
    if(empty($searchResultList)){
        response(200,"User Not Found",NULL);
    }else{
        response(200,"User Found",$searchResultList);
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

function searchUser($userName){
    $custDAFacade = new custDA_Facade();
    $result = $custDAFacade->retrieveAllUser();
    
    $searchUserName = trim($userName);
    
    $searchResultList = array();
    $index = 0;
    
    while($row = $result->fetch_object()){
        $tempUserName = $row->userName;
        
        if(stripos($tempUserName, $searchUserName) !== false){
            $searchResultList[$index]['custID'] = $row->custID;
            $searchResultList[$index]['userName'] = $row->userName;
            $searchResultList[$index]['email'] = $row->email;
            $searchResultList[$index]['gender'] = $row->gender;
            $searchResultList[$index]['status'] = $row->status;
            
        }
        $index++;
    }
    
    return $searchResultList;
}

//$result = searchUser('p');
//
//print_r($result);