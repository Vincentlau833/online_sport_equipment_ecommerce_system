<?php
//require_once '../../ErrorHandler/errorHandler.php';
require_once '../../Control/productDA.php';
//require_once '../../Control/productDA_Facade.php';
require_once '../../Control/DAFacade.php';
//require_once '../../XMLFiles/writeProductXML.php';
require_once '../../Model/Product.php';

require_once 'staffAuthorize.php';


?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Edit Product</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <link href="../css/addProduct.css" rel="stylesheet" type="text/css"/>

        <!-- Custom styles for this template-->
        <link href="../css/adminHome.css" rel="stylesheet" type="text/css"/>
        
        <script>
        window.onload = function(){
            var form = document.getElementById("editForm");
            var saveButton = document.getElementById("saveButton");
            
            form.addEventListener("input", function(){
                var nameInput = document.getElementById("prodName").value;
                var priceInput = document.getElementById("prodPrice").value;
                var descInput = document.getElementById("prodDesc").value;
                var qtyInput = document.getElementById("prodQty").value;
                
                if (nameInput === "" || priceInput === "" || descInput === "" || qtyInput === "") {
                saveButton.disabled = true;
                } else {
                saveButton.disabled = false;
                }
            });
        };
        </script>
    </head>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
            
            <?php
            require_once 'sidebar.php';
            ?>

            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content" style="padding-top: 20px;">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
                        </div>

                        <div class="row"> 
                            <!-- Content Column -->
                            <?php 
                            if($_SERVER['REQUEST_METHOD']=='GET'){ //get method
                                //get id
                                if(isset($_GET['id'])){
                                    $productID = $_GET['id'];
                                }
                            
                                $DAFacade = new DAFacade();
                                $result = $DAFacade->retrieveProduct($productID);
                            
                                if($row = $result->fetch_object()){
                                    $productName = $row->productName;
                                    $productID = $row->productID;
                                    $productPrice = (double)$row->productPrice;
                                    $productDesc = $row->productDesc;
                                    $stockQuantity = $row->stockQuantity;
                                    $productImage = $row->productImage;
                                }
                            }
                            if(isset($_POST['update'])){
                                //post method
                                if(isset($_GET['id'])){
                                    $productID = $_GET['id'];
                                }
                                $productName = $_POST['productName'];
                                $productPrice = (double)$_POST['productPrice'];
                                $productDesc = $_POST['productDesc'];
                                $stockQuantity = (int)$_POST['stockQuantity'];
                                $imagePath = $productImage;
                                
                                
                                
                                $DAFacade = new DAFacade();
                                $validationProductName = $DAFacade->validateProductName($productName);
                                $validationProductPrice = $DAFacade->validateProductPrice($productPrice);
                                $validationStockQuantity = $DAFacade->validateStockQuantity($stockQuantity);
                                $validationProductDesc = $DAFacade->validateProductDesc($productDesc);
                                
                                if($validationProductName == null && $validationProductPrice == null && $validationProductDesc == null && $validationStockQuantity == null){
                                    $product = new Product($productName,$productDesc,$productPrice,$stockQuantity,$imagePath);
                                
                                    $updateSuccess = $DAFacade->editProduct($productID, $product);
                                    
                                    if($updateSuccess){
                                        echo '<script>alert("Update Successful!");window.location.href = "productList.php";</script>';
                                    }else{
                                        echo '<script>alert("Update faileds!");</script>';
                                    }
                                }else{
                                    if($validationProductName != null){
                                            echo '<script>alert("'.$validationProductName.'");</script>';   
                                       }else if($validationProductPrice != null){
                                           echo '<script>alert("'.$validationProductPrice.'");</script>';
                                       }else if($validationStockQuantity != null){
                                           echo '<script>alert("'.$validationStockQuantity.'");</script>';
                                       }else if($validationProductDesc != null){
                                           echo '<script>alert("'.$validationProductDesc.'");</script>';
                                       }
                                }
                                
                            }
                            
                            
                            
                            ?>
                            <div class="col-lg-12 mb-4">
                                <form id="editForm" action="" method="post">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Edit Products</h6>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                        <h4 class="small font-weight-bold">Product ID 
                                            <span class="float-right"></span></h4>
                                            <input type="text" class="form-control" value="<?php echo $productID; ?>" name="productID" disabled> <br/>
                                        </div> 
                                        <div>
                                        <h4 class="small font-weight-bold">Product Name 
                                            <span class="float-right"></span></h4>
                                            <input type="text" class="form-control prodName" id="prodName" value="<?php echo $productName; ?> " name="productName"> <br/>
                                        </div> 
                                        <div>
                                        <h4 class="small font-weight-bold">Product Price (RM)
                                            <span class="float-right"></span></h4>
                                                <input type="text" id="prodPrice" class="form-control prodPrice" value="<?php echo $productPrice; ?>" name="productPrice" > <br/>
                                        </div>
                                        <div>
                                        <h4 class="small font-weight-bold">Quantity
                                            <span class="float-right"></span></h4>
                                                <input type="number" id="prodQty" class="form-control prodQty" value="<?php echo $stockQuantity; ?>" name="stockQuantity"> <br/>
                                        </div> 
                                        <div>
                                        <h4 class="small font-weight-bold">Product Description
                                            <span class="float-right"></span></h4>
                                            <textarea class="form-control prodDesc" id="prodDesc" rows="3" name="productDesc"><?php echo $productDesc; ?></textarea> <br/>
                                        </div> 
                                        <div class="addBtn">
                                        <input type="submit" class="btn btn-success" id="saveButton" values="Save Changes" name="update"/>
                                        </div>
                                    </div>
                                    
                                        
                                    
                                </div>
                                </form>
                               
                                

                            </div>
                       
                           
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; SweatLab 2023</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
       


        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
         
        
    </body>
  
 

</html>
