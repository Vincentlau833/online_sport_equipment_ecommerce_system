<?php
require_once '../../ErrorHandler/errorHandler.php';
require_once 'staffAuthorize.php';
require_once 'generatePaymentXML.php';
require_once 'generateCustomerXML.php';
require_once 'generateProductXML.php';


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

        <title>Admin Dashboard</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    
        <!-- Custom styles for this template-->
        <link href="../css/adminHome.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php
            require_once 'sidebar.php';
            
            
            ?>

            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content" style="padding-top: 20px;">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Generate Summary</h1>
                            
                            <br />
                             
                            
                            
                        </div>
                        <div>
                            <a href=""></a>
                        </div>
                        <div>
                            
                        </div>
                        <div>
                            
                        </div>
                        <?php
                        if(isset($_POST['paymentSummary'])){
                            generatePaymentXML();
                            echo "<script>window.location.href = \"Payment.xml\";</script>";
                        }else if(isset($_POST['customerSummary'])){
                            generateCustomerXML();
                            echo "<script>window.location.href = \"Customer.xml\";</script>";
                        }else if(isset($_POST['productSummary'])){
                            generateProductXML();
                            echo "<script>window.location.href = \"Product.xml\";</script>";
                        }
                        ?>
                        <div id="content-wrapper" class="d-flex flex-column">
                            <div id="content" class="col-lg-12" style="padding-top: 20px;">
                                <div class="container-fluid">
                                    <div class="col-lg-12 mb-4">
                                        <div id="content-wrapper" class="d-flex flex-column">
                                            <div class="card shadow mb-4" >
                                                <div class="card-body" >
                                                    <form action="" method="POST">
<!--                                                    <a href="Payment.xml" >Payment Summary</a>-->
                                                    <input type="submit" name="paymentSummary" class="btn btn-success" value="Payment Report" style="width: 100%;height: 180px;display: flex;align-items: center; justify-content: center;"/>
                                                    </form>
                                                    <br />
                                                    <form action="" method="POSt">
<!--                                                    <a href="Customer.xml" class="btn btn-secondary" style="width: 100%;height: 180px;display: flex;align-items: center; justify-content: center;">Customer Summary</a>-->
                                                    <input type="submit" name="customerSummary" class="btn btn-info" value="Customer Report" style="width: 100%;height: 180px;display: flex;align-items: center; justify-content: center;"/>
                                                    </form>
                                                    <br />
                                                    <form action="" method="POSt">
                                                    <!--<a href="Customer.xml" class="btn btn-secondary" style="width: 100%;height: 180px;display: flex;align-items: center; justify-content: center;">Customer Summary</a>-->
                                                    <input type="submit" name="productSummary" class="btn btn-warning" value="Product Report" style="width: 100%;height: 180px;display: flex;align-items: center; justify-content: center;"/>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Row -->

                        <div class="row">

                     

                        
                        </div>

                        <!-- Content Row -->
                        <div class="row">


                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

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
