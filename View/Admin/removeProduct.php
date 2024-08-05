<?php
require_once '../../Control/productDA.php';
//require_once '../../Control/productDA_Facade.php';
require_once '../../Control/DAFacade.php';
require_once '../../Model/Product.php';
//require_once '../../ErrorHandler/errorHandler.php';

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

        <title>Remove Product</title>

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
                            <h1 class="h3 mb-0 text-gray-800">Remove Product</h1>
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-download fa-sm text-white-50"></i> Logout</a>
                        </div>

                        <div class="row">
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
                                }
                            }
                            
                            if(isset($_POST['removeBtn'])){
                                if(isset($_GET['id'])){
                                    $productID = $_GET['id'];
                                }
                                
                                $DAFacade = new DAFacade();
                                $removeSuccess = $DAFacade->deleteProduct($productID);
                                
                                if($removeSuccess){
                                    echo '<script>alert("Remove Successful!"); window.location.href = "productList.php";</script>';
                                   
                                }else{
                                    echo '<script>alert("Remove Failed");window.location.href = "productList.php";</script>';
                                }
                            }
                            
                            ?>
                            <!-- Content Column -->
                            <div class="col-lg-12 mb-4">
                                <form id="delForm" action="" method="POST">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Remove Product</h6>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                        <h4 class="small font-weight-bold">Product ID 
                                            <span class="float-right"></span></h4>
                                                <input type="text" class="form-control" value="<?php echo $productID; ?>" disabled name="productID"> <br/>
                                        </div> 
                                        <div>
                                        <h4 class="small font-weight-bold">Product Name 
                                            <span class="float-right"></span></h4>
                                            <input type="text" class="form-control prodName" id="prodName" value="<?php echo $productName; ?>" disabled name="productName"> <br/>
                                        </div>
                                        <h4 class="small font-weight-bold">Product Price
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">RM</span>
                                            </div>
                                            <input type="number" id="prodPrice" class="form-control prodPrice" aria-label="price" aria-describedby="basic-addon1" value="<?php echo $productPrice; ?>" disabled name="productPrice">
                                        </div>
                                        <div>
                                        <h4 class="small font-weight-bold">Quantity
                                            <span class="float-right"></span></h4>
                                                <input type="number" id="prodQty" class="form-control prodQty" value="<?php echo $stockQuantity; ?>" disabled name="stockQuantity"> <br/>
                                        </div> 
                                        <div>
                                        <h4 class="small font-weight-bold">Product Description
                                            <span class="float-right"></span></h4>
                                            <textarea class="form-control prodDesc" id="prodDesc" rows="3" disabled name="productDesc"><?php echo $productDesc; ?></textarea> <br/>
                                        </div> 
                                        <div class="addBtn">
                                        <input type="submit" class="btn btn-danger" id="saveButton" value="Remove" name="removeBtn">
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
