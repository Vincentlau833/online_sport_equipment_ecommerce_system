<?php

require_once '../../Control/custDA.php';
require_once '../../Model/Product.php';
//require_once '../../Control/custDA_Facade.php';
require_once '../../Control/DAFacade.php';
require_once '../../ErrorHandler/errorHandler.php';




 if(isset($_GET['id']) && isset($_GET['status'])){
   $custID = $_GET['id'];
   $status = $_GET['status'];
 }

$DAFacade = new DAFacade();

if($status == "ban"){
    $banSuccessful = $DAFacade->ban($custID);
    if($banSuccessful){
        echo '<script>window.location.href = "userList.php";</script>';
    }
}else{
    $activateSuccessful = $DAFacade->activate($custID);
    if($activateSuccessful){
        echo '<script>window.location.href = "userList.php";</script>';
    }
}

// $banSuccessful = $custDAFacade->ban($custID);
//

 
 
