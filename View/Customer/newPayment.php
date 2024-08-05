<?php
require_once '../../Control/productDA.php';
require_once '../../Control/orderDA.php';
require_once '../../Control/DAFacade.php';
require_once '../../Model/Product.php';
require_once '../../Model/Payment.php';
require_once '../../Model/Order.php';
require_once '../../Model/OrderDetails.php';
//require_once '../../ErrorHandler/errorHandler.php';

require_once '../../SessionEncryption/SessionEncrypt.php';
require_once '../../SessionEncryption/config.php';
?>

<?php 
session_start();
$sessionEncryption = new SessionEncrypt(SESSION_KEY);

$productDA = new ProductDA();

if(isset($_SESSION['custID'])){
    $custID = $sessionEncryption->decrypt($_SESSION['custID']);
}

if(isset($_SESSION['cartList'])){
    $cartList = $_SESSION['cartList'];//cart List id
}



if(isset($_SESSION['quantityArray'])){
    $quantityArray = $_SESSION['quantityArray'];
}

//store payment details into database
if(isset($_POST['checkout'])){//payment
    //insert into custOrder Table
    $orderStatus = "Order Received";
    
    $custOrder = new Order($orderStatus,$custID);
    $orderDA = new orderDA();
    $custOrderInsertSuccess = $orderDA->insertOrder($custOrder);
    
    if($custOrderInsertSuccess){
        echo '<script>alert("Order Success");</script>'; 
    }else{
        echo '<script>alert("Order Failed");</script>'; 
    }
    
    //insert product into orderDetails table
    $id = $orderDA->getNumOfRecords();//orderID
    $orderDate = date('Y-m-d');//get date
          
    $timezone = new DateTimeZone('Asia/Kuala_Lumpur');
    $date = new DateTime('now', $timezone);
    $orderTime = $date->format('H:i:s');//get time
    
    
    for($i=0;$i<count($cartList);$i++){
        $orderDetails = new OrderDetails($id,$cartList[$i],$quantityArray[$i],$orderDate,$orderTime);
        $insertSuccess = $orderDA->insertOrderDetails($orderDetails);        
    }
    
    //add to payment record
    $DAFacade = new DAFacade();
    //get payment amount
    $paymentAmount = $_POST['paymentAmount'];
    
    $payment = new Payment($paymentAmount,"Online Banking",$orderDate,$orderTime,$id);
    $DAFacade->insertPayment($payment);
    
    //clear the array
    unset($cartList);
    unset($quantityArray);
    
    $_SESSION['cartList'] = $cartList;
    $_SESSION['quantityArray'] = $quantityArray;
    
    echo '<script>window.location.href = "productMen.php";</script>';
    
    
}
?>
<?php  
require_once '../requiredFile/header.php';
?>
<html>
    
    <head>
        <meta charset="UTF-8">
        <link href="../css/newPayment.css" rel="stylesheet" type="text/css"/>
    </head>
    <body style="background: #D3CCE3; background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3); background: linear-gradient(to right, #E9E4F0, #D3CCE3); "">
        <!--<div class="formBody">-->
        <!--Display receipt-->
        <h2 style="padding-top: 60px;padding-bottom: 10px;margin: auto;">Check Out List</h2>
        
        <form action="" method="POST" id="form" style="padding-bottom: 80px;width: 65%;margin: auto;">
            <table border="1" class="table table-striped table-dark" id="paymentTable">
            <thead class="thead-dark">
            <tr>
                <th>Product Name</th>
                <th>Purchase Quantity</th>
                <th>Product Price(One)</th>
                <th>Product Price(total)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totalAmount = 0;
            for($i=0;$i<count($cartList);$i++){
                $result = $productDA->retrieveProduct($cartList[$i]);
                if($row = $result->fetch_object()){
                    $productName = $row->productName;
                    $productPrice = $row->productPrice;
                    $productQuantity = $quantityArray[$i];
                    $productTotalPrice = $productPrice * $productQuantity;
                    $totalAmount = $totalAmount + $productTotalPrice;
                    printf("
                            <tr>
                            <td>%s</td>
                            <td>%s</td>
                            <td>RM %.2f</td>
                            <td>RM %.2f</td>
                            </tr>
                           "
                            ,$productName,$productQuantity,$productPrice,$productTotalPrice);
                }
            }
            ?>
            <tr>
                <td colspan="3">Total Amount</td>
                <td colspan="1">RM <?php printf("%.2f",$totalAmount); ?></td>
            </tr>
            </tbody>
        </table> 
            <div style="text-align:center; padding-top: 40px;">
            <input class="btn btn-warning" id="checkoutBtn" style="width: 20%;" type="submit" name="checkout" value="Checkout" />
            <input type="hidden" name="paymentAmount" value="<?php echo $totalAmount; ?>" />
            </div>
        </form>
            <!--</div>-->
        <?php
        require_once '../requiredFile/footer.php';
        ?>
    </body>
</html>
