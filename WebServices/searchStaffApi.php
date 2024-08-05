<?php

require_once '../Control/staffDA_Facade.php';
header("Content-Type:application/json");

if(!empty($_GET['staffName'])){
    $staffName = $_GET['staffName'];
    $searchResultList = searchStaff($staffName);
    
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

function searchStaff($staffName){
    $staffDAFacade = new StaffDA_Facade();
    $result = $staffDAFacade->retrieveAllStaffs();
    
    $searchStaffName = trim($staffName);
    
    $searchResultList = array();
    $index = 0;
    
    while($row = $result->fetch_object()){
        $tempStaffName = $row->staffName;
        
        if(stripos($tempStaffName, $searchStaffName) !== false){
            $searchResultList[$index]['staffID'] = $row->staffID;
            $searchResultList[$index]['staffName'] = $row->staffName;
            $searchResultList[$index]['email'] = $row->email;
            $searchResultList[$index]['gender'] = $row->gender;
            $searchResultList[$index]['contactNo'] = $row->contactNo;
            
        }
        $index++;
    }
    
    return $searchResultList;
}

//$result = searchUser('p');
//
//print_r($result);