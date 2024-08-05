<?php
require_once '../../Control/productDA.php';
//require_once '../../Control/productDA_Facade.php';
require_once '../../Control/DAFacade.php';
require_once '../../Model/Product.php';
//require_once '../../ErrorHandler/errorHandler.php';

require_once '../../SessionEncryption/SessionEncrypt.php';
require_once '../../SessionEncryption/config.php';

require_once 'customerAuthorize.php';
?>
<?php 
$DAFacade = new DAFacade();

//start the session and get the product id from the session
//session_start();

if(!isset($_SESSION['custID'])){
    echo '<script>alert("*Please login your account first.");</script>';
    echo '<script>window.location.href = "../login.php";</script>';
}

if(isset($_SESSION['cartList'])){
    $cartList = $_SESSION['cartList'];//cart List id
}




?>

<?php
if(isset($_POST['proceedPayment'])){
    //$cartEmpty = (boolean)$_POST['cartEmpty'];
    if(!empty($cartList)){ //cart not empty
    
        //get quantity list of the product
        $quantityArray = array();
        //use for loop and store the quantity into an array
        for($i=0;$i<count($cartList);$i++){
            //$productQuantity = "productQuantity_".$i;
            $qty = $_POST['productQuantity_'.$i];
            array_push($quantityArray,$qty);
        
        
        }
    
        $_SESSION['quantityArray'] = $quantityArray;
    
        echo '<script>window.location.href = "newPayment.php";</script>';
    }else{
        echo '<script>alert("You cannot process to payment if the cart is empty.");</script>';
    }
    
}
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
    require_once '../requiredFile/header.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
        <title>Cart</title>
    </head>
    <body>
        <section class="h-100" style="background: #D3CCE3; background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3); background: linear-gradient(to right, #E9E4F0, #D3CCE3); ">
            <div class="container h-100 py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-10">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                            
                        </div>

                        
                        <!--Product start-->
                        <form action="" method="post">
                        <?php
                        if(isset($cartList)){
                        for($i = 0;$i < count($cartList);$i++){
                            $result = $DAFacade->retrieveProduct($cartList[$i]);
                            if($row = $result->fetch_object()){
                                printf("
                                <div class=\"card rounded-3 mb-4\">
                                    <div class=\"card-body p-4\">
                                        <div class=\"row d-flex justify-content-between align-items-center\">
                                            <div class=\"col-md-2 col-lg-2 col-xl-2\">
                                                <img
                                                    src=\"%s\"
                                                    class=\"img-fluid rounded-3\" alt=\"Cotton T-shirt\">
                                            </div>
                                            <div class=\"col-md-3 col-lg-3 col-xl-3\">
                                                <p class=\"lead fw-normal mb-2\">%s</p>
                                                <p><span class=\"text-muted\">Size: </span>M <span class=\"text-muted\">Color: </span>Grey</p>
                                            </div>
                                            <div class=\"col-md-3 col-lg-3 col-xl-2 d-flex\">
                                                <button class=\"btn btn-link px-2\"
                                                    onclick=\"this.parentNode.querySelector(\'input[type=number]\').stepDown()\">
                                                    
                                                </button>

                                                <input id=\"form1\" min=\"1\"  value=\"1\" type=\"number\"
                                                name=\"productQuantity_%s\"
                                                       class=\"form-control form-control-sm\" />
                                                
                                                <button class=\"btn btn-link px-2\" 
                                                        onclick=\"this.parentNode.querySelector(\'input[type=number]\').stepUp()\">
                                              
                                                </button>
                                            </div>
                                            <div class=\"col-md-3 col-lg-2 col-xl-2 offset-lg-1\">
                                                <h5 class=\"mb-0\"></h5>
                                            </div>
                                            <div class=\"col-md-1 col-lg-1 col-xl-1 text-end\">
                                                
                                                
                                                <a href=\"removeProduct.php?id=%s\" class=\"text-danger\"><i class=\"fa fa-trash fa-lg\"></i></a>
                                                
                                               
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>",$row->productImage,$row->productName,$i,$row->productID);
                                }
                            
                            }
                        $empty = false; //check the cart empty or not
                        } else{
                            echo "<div>";
                            echo "No product added";
                            echo "</div>";
                            $empty = true;
                        }
                        ?>
                        <!--Product end-->
                        
                        
                        


                        <div class="card">
                            <div class="card-body" style="text-align: center">
                                <button type="submit" class="btn btn-warning btn-block btn-lg" name="proceedPayment">
                                    Proceed to Payment</button>
                                <input type="hidden" value="<?php echo $empty ?>" name="cartEmpty"/>
                            </div>
                        </div>
                        </form>
                        
                       

                    </div>
                </div>
            </div>
        </section>
        
        
        <?php
        require_once '../requiredFile/footer.php';
        ?>
    </body>
</html>
