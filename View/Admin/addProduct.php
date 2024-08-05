<?php
require_once '../../Control/productDA.php';
//require_once '../../Control/productDA_Facade.php';
require_once '../../Control/DAFacade.php';
require_once '../../Model/Product.php';
//require_once '../../ErrorHandler/errorHandler.php';
//header('Location: login.php');

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

        <title>Add Product</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <link href="../css/addProduct.css" rel="stylesheet" type="text/css"/>

        <!-- Custom styles for this template-->
        <link href="../css/adminHome.css" rel="stylesheet" type="text/css"/>
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
                            <h1 class="h3 mb-0 text-gray-800">Add New Product</h1>
<!--                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-download fa-sm text-white-50"></i> Logout</a>-->
                        </div>

                        <div class="row">
                            
                            <!-- Content Column -->
                            <div class="col-lg-12 mb-4">
                                <?php
                                //insert product into database
                                if(!empty($_POST)){
                                    $productName = $_POST['productName'];
                                    $productPrice = (double)$_POST['productPrice'];
                                    $productDesc = $_POST['productDesc'];
                                    $stockQuantity = (int)$_POST['stockQuantity'];
                                    //get product image information
                                    if(isset($_FILES['productImage'])){
                                        $file_name = $_FILES["productImage"]["name"];
                                        $file_type = $_FILES["productImage"]["type"];
                                        $file_size = $_FILES["productImage"]["size"];
                                        $file_tmp = $_FILES["productImage"]["tmp_name"];
                                    }
                                    
                                    
                                    
                                    $DAFacade = new DAFacade();
                                    $validationProductName = $DAFacade->validateProductName($productName);
                                    $validationProductPrice = $DAFacade->validateProductPrice($productPrice);
                                    $validationStockQuantity = $DAFacade->validateStockQuantity($stockQuantity);
                                    $validationProductDesc = $DAFacade->validateProductDesc($productDesc);
                                    $validationProductImage = $DAFacade->validateProductImage($file_type, $file_size);
                                    
                                    if($validationProductName == null && $validationProductPrice == null && $validationProductDesc == null && $validationStockQuantity == null /*&& $validationProductImage == null*/){
                                        
                                        //upload image
                                        $productImagePath = "../ProductImages/".$file_name;
                                        move_uploaded_file($file_tmp, $productImagePath);
                                        
                                        $product = new Product($productName,$productDesc,$productPrice,$stockQuantity,$productImagePath);
                                        $addSuccess = $DAFacade->insertProduct($product);
                                    
                                        if($addSuccess){
                                            echo "<script>alert('Add Success');window.location.href = \"productList.php\";</script>";
                                        
                                        }else{
                                            echo "<script>alert('Add Fail');window.location.href = \"productList.php\";</script>";

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
                                
                                <div id="content-wrapper" class="d-flex flex-column">
                                <form action="" method="POST" enctype="multipart/form-data">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">New Products</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-3">
<!--                                        <h4 class="small font-weight-bold">Product ID -->
                                            <span class="float-right"></span></h4>
<!--                                                <input type="text" class="form-control" placeholder="C001" disabled>-->
                                                <h4 class="small font-weight-bold">Select Image
                                                    <span class="float-right"></span></h4>
                                                    <input class="form-control" type="file" name="productImage" required>
                                        </div> 
                                        <br />
                                        <div>
                                        <h4 class="small font-weight-bold">Product Name 
                                            <span class="float-right"></span></h4>
                                                <input type="text" class="form-control" name="productName" value="<?php echo isset($productName)? $productName : '' ?>"> <br/>
                                        </div> 
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="price" aria-describedby="basic-addon1" name="productPrice" value="<?php echo isset($productPrice)? $productPrice : '' ?>">
                                        </div>
                                        <div>
                                        <h4 class="small font-weight-bold">Quantity
                                            <span class="float-right"></span></h4>
                                            <input type="number" class="form-control" name="stockQuantity" value="<?php echo isset($stockQuantity)? $stockQuantity : '' ?>"> <br/>
                                        </div> 
                                        <div>
                                        <h4 class="small font-weight-bold">Product Description
                                            <span class="float-right"></span></h4>
                                                <textarea class="form-control" id="" rows="3"name="productDesc"><?php echo isset($productDesc)? $productDesc : '' ?></textarea><br/>
                                        </div> 
                                        <div class="addBtn">
                                        <input type="submit" class="btn btn-dark" value="Add New Product">
                                        </div>
                                    </div>
                                    
                                        
                                    
                                </div>
                                </form>
                                    
                                    </div>
                                

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
