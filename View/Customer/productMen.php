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
        //store the selected data into session 
        $DAFacade = new DAFacade();
        if(isset($_POST['addToCart'])){
            $cartProductID = $_POST['productID'];
            
            //arrays
            
            //create session
            //session_start();
            
            //create session encrypt class
            
//            $cartProductArray = array();
//            array_push($cartProductArray,$cartProductID);
            
                if(!isset($_SESSION['cartList'])){
                    //no session yet
                    $_SESSION['cartList'] = array();
                    $cartList = $_SESSION['cartList'];
                    //put the first product in the cartList
                    if(!$DAFacade->checkProductExist($cartList,$cartProductID)){
                        array_push($cartList,$cartProductID);
                        $newCartList = $cartList;
                        $_SESSION['cartList'] = $newCartList;
                        if(isset($_SESSION['cartList'])){
                            echo '<script>alert("Product added");</script>'; 
                        }
                    }else{
                        echo '<script>alert("Product exist");</script>';
                    }
                
                }else{
                    //session exist
                    $cartList = $_SESSION['cartList'];
                    if(!$DAFacade->checkProductExist($cartList,$cartProductID)){
                        array_push($cartList,$cartProductID);
                
                        $newCartList = $cartList;
                
                        $_SESSION['cartList'] = $newCartList;
                
                        if(isset($_SESSION['cartList'])){
                            echo '<script>alert("Product added");</script>'; 
                        }
                    }else{
                        echo '<script>alert("Product exist");</script>';
                    }
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
        <meta charset="UTF-8">
        <title>Product</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
        <link href="../css/productMen.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        
        
        <h1 style="text-align: center;padding-top: 10px;">Our Products</h1>
        <div style="text-align: center">
            <form method="POST" action="" >
            <input type="text" class="form-control" style="width: 30%;padding-top: 8px; padding-bottom: 8px"  placeholder="Search product here" name="searchProduct" required/>
            <input type="submit" style="padding-top: 8px; padding-bottom: 7px" name="search" value="Search" class="btn btn-outline-success my-2 my-sm-0 searchbtn"/>
            </form>
        </div>
        <br />
        <div class="grid-container">
        <?php 
        //get productList
//        $productDAFacade = new productDA_Facade();
//        $result = $productDAFacade->retrieveProductList();
//        
//        while($row=$result->fetch_object()){
//           printf(
//                    "<div class=\"container\">
//            <div class=\"col-md-12 bootstrap snippets bootdeys\">
//                <!-- product -->
//                <div class=\"product-content product-wrap clearfix product\">
//                    <div class=\"row\">
//                        <div class=\"col-md-5 col-sm-12 col-xs-12\">
//                            <div class=\"product-image\"> 
//                                <img src=\"https://www.bootdey.com/image/194x228/87CEFA\" style=\"width:192px;height:228px;\" alt=\"194x228\" class=\"img-responsive\"> 
//                                
//                            </div>
//                        </div>
//                        <div class=\"col-md-7 col-sm-12 col-xs-12\">
//                            <div class=\"product-deatil\">
//                                <h5 class=\"name\">
//                                    <a href=\"#\">
//                                        %s 
//                                    </a>
//                                </h5>
//                                <p class=\"price-container\">
//                                    <span>RM %.2f</span>
//                                </p>
//                                <span class=\"tag1\"></span> 
//                            </div>
//                            <div class=\"description\">
//                                <p>%s </p>
//                            </div>
//                            <div class=\"product-info smart-form\">
//                                <div class=\"row\">
//                                    <div class=\"addcart\">
//                                    <form action=\"\" method=\"POST\">
//                                        
//                                        <input type=\"submit\" name=\"addToCart\" class=\"btn btn-success \" value=\"Add To Cart\"/>
//                                        <input type=\"hidden\" name=\"productID\" class=\"btn btn-success \" value=\"%s\"/>
//                                    </form>
//                                    </div>
//                                    
//                                </div>
//                            </div>
//                        </div>
//                    </div>
//                </div>
//                <!-- end product -->
//            </div>
//            
//          
//          
//        </div>",$row->productName,(double)$row->productPrice,$row->productDesc,$row->productID);
//        }
        
        //retrieve the product by using the searching api
        if(!isset($_POST['search'])){
            //retrieve all the product from the database
            $DAFacade = new DAFacade();
            $result = $DAFacade->retrieveProductList();
        
            while($row=$result->fetch_object()){
            printf(
                        "<div class=\"container\">
                <div class=\"col-md-12 bootstrap snippets bootdeys\">
                    <!-- product -->
                    <div class=\"product-content product-wrap clearfix product\">
                        <div class=\"row\">
                            <div class=\"col-md-5 col-sm-12 col-xs-12\">
                                <div class=\"product-image\"> 
                                    <img src=\"%s\" alt=\"194x228\" class=\"img-responsive\"  style=\"width:192px;height:228px;\"> 
                                
                                </div>
                            </div>
                            <div class=\"col-md-7 col-sm-12 col-xs-12\">
                                <div class=\"product-deatil\">
                                    <h5 class=\"name\">
                                        <a href=\"#\">
                                            %s 
                                        </a>
                                    </h5>
                                    <p class=\"price-container\">
                                        <span>RM %.2f</span>
                                    </p>
                                    <span class=\"tag1\"></span> 
                                </div>
                                <div class=\"description\">
                                    <p>%s </p>
                                </div>
                                <div class=\"product-info smart-form\">
                                    <div class=\"row\">
                                        <div class=\"addcart\">
                                        <form action=\"\" method=\"POST\">
                                        
                                            <input type=\"submit\" name=\"addToCart\" class=\"btn btn-success \" value=\"Add To Cart\"/>
                                            <input type=\"hidden\" name=\"productID\" class=\"btn btn-success \" value=\"%s\"/>
                                        </form>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end product -->
                </div>
            
          
          
            </div>",$row->productImage,$row->productName,(double)$row->productPrice,$row->productDesc,$row->productID);
            }
        }else{
            //call the api to display the search result
            $productName = str_replace(' ','',$_POST['searchProduct']);
            
            $url = "http://localhost/SweatLab/WebServices/searchAPI.php?productName=" . $productName;

            $client = curl_init($url);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);

            $result = json_decode($response);
            $resultList = $result->data;//array of result search
            
            if(!empty($resultList) && $resultList != null){
                //display the all product found from the tesult list
                foreach($resultList as $product){
                    $productID = $product->productID;
                    $productName = $product->productName;
                    $productPrice = $product->productPrice;
                    $productDesc = $product->productDesc;
                    $stockQuantity = $product->stockQuantity;
                    $productImage = $product->productImage;
                    
                    //print the product from the array
                    printf(
                        "<div class=\"container\">
                <div class=\"col-md-12 bootstrap snippets bootdeys\">
                    <!-- product -->
                    <div class=\"product-content product-wrap clearfix product\">
                        <div class=\"row\">
                            <div class=\"col-md-5 col-sm-12 col-xs-12\">
                                <div class=\"product-image\"> 
                                    <img src=\"%s\" alt=\"194x228\" class=\"img-responsive\" > 
                                
                                </div>
                            </div>
                            <div class=\"col-md-7 col-sm-12 col-xs-12\">
                                <div class=\"product-deatil\">
                                    <h5 class=\"name\">
                                        <a href=\"#\">
                                            %s 
                                        </a>
                                    </h5>
                                    <p class=\"price-container\">
                                        <span>RM %.2f</span>
                                    </p>
                                    <span class=\"tag1\"></span> 
                                </div>
                                <div class=\"description\">
                                    <p>%s </p>
                                </div>
                                <div class=\"product-info smart-form\">
                                    <div class=\"row\">
                                        <div class=\"addcart\">
                                        <form action=\"\" method=\"POST\">
                                        
                                            <input type=\"submit\" name=\"addToCart\" class=\"btn btn-success \" value=\"Add To Cart\"/>
                                            <input type=\"hidden\" name=\"productID\" class=\"btn btn-success \" value=\"%s\"/>
                                        </form>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end product -->
                </div>
            
          
          
            </div>",$productImage,$productName,(double)$productPrice,$productDesc,$productID);
                }
               
            }else if($resultList == null){
                echo "No record found";
            }
            
        }
        
        ?>
            <!--Product Start-->
            
           <!--Product End-->
           
            
            
          
          
        </div>
          
          <?php
            require_once '../requiredFile/footer.php';
        ?>
    </body>
</html>
