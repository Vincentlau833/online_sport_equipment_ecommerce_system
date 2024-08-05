<?php
require_once '../../Control/productDA.php';
require_once '../../Model/Product.php';
require_once '../../ErrorHandler/errorHandler.php';
require_once 'customerAuthorize.php';

$productDA = new ProductDA();
//session_start();
if(isset($_SESSION['cartList'])){
    $cartList = $_SESSION['cartList'];//cart List id
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $key = array_search($id, $cartList);
    if ($key !== false) {
        unset($cartList[$key]);
    }
    
    
    // Shift the remaining elements to the front of the array
    $cartList = array_values($cartList);
    
    
    $_SESSION['cartList'] = $cartList;
    
    echo '<script>window.location.href = "cart.php";</script>';
}

//for($i=0;$i<count($cartList);$i++){
//    echo $cartList[$i];
//}