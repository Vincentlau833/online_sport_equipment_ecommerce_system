<?php
require_once '../../Control/staffDA.php';
//require_once '../../Control/staffDA_Facade.php';
require_once '../../Control/DAFacade.php';
require_once '../../Model/Staff.php';
//require_once '../../ErrorHandler/errorHandler.php';

require_once 'staffAuthorize.php';
 require_once 'adminAuthorize.php';

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

        <title>Insert Staff</title>

        <!-- Custom fonts for this template-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <link href="../css/productList.css" rel="stylesheet" type="text/css"/>
        <link href="../css/adminHome.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body id="page-top">
        <div id="wrapper">
        <?php
            require_once 'sidebar.php';
            
            if(isset($_POST['addStaff'])){
                $staffName = $_POST['staffName'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $contactNo = $_POST['contactNo'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];
                
                $DAFacade = new DAFacade();
                
                $validationStaffName = $DAFacade->validateStaffName($staffName);
                $validationEmail = $DAFacade->validateEmail($email);
                $validationPassword = $DAFacade->validatePassword($password, $confirmPassword);
                $validationContactNo = $DAFacade->validateContactNo($contactNo);
                
                if($validationStaffName == null && $validationEmail == null && $validationPassword == null && $validationContactNo == null){
                    //hash the password
                    $hashed_password = password_hash($password, PASSWORD_ARGON2I);
                    
                    $staff = new Staff($staffName,$email,$hashed_password,$gender);
                    //$staff->setContactNo($contactNo);
                
                    $addSuccess = $DAFacade->insertStaff($staff,$contactNo);
                    if($addSuccess){
                        echo "<script>alert('Add Success');window.location.href = \"staffList.php\";</script>";
                    }else{
                        echo "<script>alert('Add Fail');window.location.href = \"productList.php\";</script>";
                    }   
                }else{
                    if($validationStaffName != null){
                        echo "<script>alert('".$validationStaffName."');</script>";
                    }else if($validationEmail != null){
                        echo "<script>alert('".$validationEmail."');</script>";
                    }else if($validationPassword != null){
                        echo "<script>alert('".$validationPassword."');</script>";
                    }else if($validationContactNo != null){
                        echo "<script>alert('".$validationContactNo."');</script>";
                    }
                }
                
            }
            
        ?>
            
           <div id="content-wrapper" class="d-flex flex-column">
               
               
               <!-- Main Content -->
                <div id="content" style="padding-top: 20px;">
                    
                    <div class="container-fluid">
                        
                        
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Add New Staff</h1>
                        </div>
                        <div class="col-lg-12 mb-4">
                    
                            <div id="content-wrapper" class="d-flex flex-column">
                   <!--Insert staff -->
                   <form action="" method="POST">
                       <div class="card shadow mb-4">
                           <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">New Staff</h6>
                           </div>
                           
                           <div class="card-body">
                           
                               <div>
                                   <h4 class="small font-weight-bold">Name 
                                        <span class="float-right"></span></h4>
                                        <input class="form-control" type="text" name="staffName" placeholder="Enter staff name" value="<?php echo isset($staffName)? $staffName : "" ?>"/>
                                        <br/>
                               </div>
                               
                               <div>
                                        <h4 class="small font-weight-bold">Email
                                            <span class="float-right"></span></h4>
                                            <input type="text" class="form-control" name="email" placeholder="Enter staff email" value="<?php echo isset($email)? $email:"" ?>"> <br/>
                                        </div> 
                               
                               <div>
                                   <h4 class="small font-weight-bold">Gender
                                    <span class="float-right"></span></h4>
                                    <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" value="M" <?php echo isset($gender) ? "" : "checked" ?> <?php echo isset($gender) && $gender == 'M' ? "checked" : '' ?>  />Male
                                    </div>
                                   <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" value="F" <?php echo isset($gender) && $gender == 'F' ? "checked" : '' ?>/>Female
                                    </div>

                               </div>
                               
                             
                       <br>
                       
                       <div>
                           <h4 class="small font-weight-bold">Contact No
                               <span class="float-right"></span></h4>
                           <input type="text" class="form-control" name="contactNo" placeholder="Enter staff contact number" value="<?php echo isset($contactNo)? $contactNo : '' ?>">
                       </div> 
                       <br>
                       
                       <div>
                           <h4 class="small font-weight-bold">Password
                               <span class="float-right"></span></h4>
                           <input type="password" class="form-control" name="password"  placeholder="Enter password" value="<?php echo isset($password)? $password:"" ?>">
                       </div> 
                      
                       <br/>
                       
                       <div>
                           <h4 class="small font-weight-bold">Confirm Password
                               <span class="float-right"></span></h4>
                           <input type="password" class="form-control" name="confirmPassword"  placeholder="Enter confirm password" value="<?php echo isset($confirmPassword)? $confirmPassword:"" ?>"> 
                       </div>
                       
                       <br/>
                       <div class="row">
                           <div class="col-md-6 addBtn">
                               <input style="float: right" type="submit" class="btn btn-dark" value="Add Staff" name="addStaff" /> 
                           </div>
                           <div class="col-md-6 addBtn">
                               <input type="reset" class="btn btn-danger" value="Cancel" name="addStaff" /> 
                           </div>
                       </div>

                       
                        </div>
                       </div>
                   </form>
                   </div>
                        </div>
                   </div>
                </div>
               
               
               
               
               <footer class="sticky-footer bg-white">
                   <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; SweatLab 2023</span>
                        </div>
                    </div>
               </footer>
           </div>
            </div>
        
        
        
    </body>
</html>
