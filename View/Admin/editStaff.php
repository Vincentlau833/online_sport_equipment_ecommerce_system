<?php
require_once '../../Control/custDA.php';
require_once '../../Model/staff.php';
//require_once '../../Control/staffDA_Facade.php';
require_once '../../Control/DAFacade.php';
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

        <title>Edit Staff</title>

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
        ?>
            <?php
            if($_SERVER['REQUEST_METHOD']=='GET'){//get method
                //get id
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                
                $DAFacade = new DAFacade();
                $result = $DAFacade->retrieveStaff($id);
                
                if($row = $result->fetch_object()){
                    $staffName = $row->staffName;
                    $email = $row->email;
                    $gender = $row->gender;
                    $contactNo = $row->contactNo;
                }
                
            }
            
            if(isset($_POST['update'])){
                //get id
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                
                $staffName = $_POST['staffName'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $contactNo = $_POST['contactNo'];
                
                $DAFacade = new DAFacade();
                
                $validationStaffName = $DAFacade->validateStaffName($staffName);
                $validationEmail = $DAFacade->validateStaffEmail($email);
                //validationContactNo
                if($validationStaffName == null && $validationEmail == null){
                    $updateSuccess = $DAFacade->updateStaffInfo($id, $staffName, $email, $contactNo,$gender);
                    if($updateSuccess){
                        echo "<script>alert('Update Success');window.location.href = \"staffList.php\";</script>";
                    }else{
                        echo "<script>alert('Update Falied');window.location.href = \"staffList.php\";</script>";
                    }
                }else{
                    if($validationStaffName != null){
                        echo "<script>alert('".$validationStaffName."')</script>";
                    }else if($validationEmail != null){
                        echo "<script>alert('".$validationEmail."')</script>";
                    }
                }
            }
            
            if(isset($_POST['changePassword'])){
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                
                $oldPassword = $_POST['oldPassword'];
                $newPassword = $_POST['newPassword'];
                $confirmPassword = $_POST['confirmPassword'];
                
                $DAFacade = new DAFacade();
                
                //compare the old password with the password store in database
                $passwordMatch = $DAFacade->verifyPassword($id, $oldPassword);
                
                //compare the new password and the confirm password
                $validationPassword = $DAFacade->validateStaffPassword($newPassword, $confirmPassword);
                
                if($passwordMatch && $validationPassword == null){
                    //change the password
                    //echo '<script>alert("Password match.");</script>';
                    $newHashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID);
                    $changeSuccess = $DAFacade->changePassword($id, $newHashedPassword);
                    if($changeSuccess){
                        echo '<script>alert("Change password successful.");</script>';
                    }else{
                        echo '<script>alert("Change password failed.");</script>';
                    }
                }else{
                    //password does not match or validatation fail
                    if(!$passwordMatch){
                        //password does not match
                        //display password does not match message
                        echo '<script>alert("Password entered does not match.");</script>';
                    }else if($validationPassword != null){
                        //display error message
                        echo '<script>alert("'.$validationPassword.'");</script>';
                    }
                }
                
            }
            ?>
            
           <div id="content-wrapper" class="d-flex flex-column">
               
               
               <div id="content" class="col-lg-12" style="padding-top: 20px;">
                   <div class="container-fluid">
                       
                       <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Edit Staff</h1>
                        </div>
                       
                       <div class="row">
                   
                   
                  
                   <!--Insert staff -->
                   <div class="col-lg-12 mb-4">
                   <form action="" method="POST">
                       <div class="card shadow mb-4">
                           <div class="card-header py-3">
                               <h6 class="m-0 font-weight-bold text-primary">Edit Staff</h6>
                           </div>
                           <div class="card-body">
                               <div>
                                   <h4 class="small font-weight-bold">ID
                                       <span class="float-right"></span></h4>
                                   <input type="text" placeholder="Enter staff name" class="form-control" value="<?php echo isset($id)? $id:"" ?>" name="staffName" disabled> <br/>
                               </div> 
                               <div>
                                   <h4 class="small font-weight-bold">Name
                                       <span class="float-right"></span></h4>
                                   <input type="text" class="form-control prodName" placeholder="Enter staff name" id="prodName" value="<?php echo isset($staffName)? $staffName : "" ?>" name="staffName"> <br/>
                               </div> 
                               <div>
                                   <h4 class="small font-weight-bold">Email
                                       <span class="float-right"></span></h4>
                                   <input type="text" class="form-control prodName" placeholder="Enter staff email" id="prodName" value="<?php echo isset($email)? $email:"" ?>" name="email"> <br/>
                               </div> 
                               <div>
                                   <h4 class="small font-weight-bold">Gender
                                    <span class="float-right"></span></h4>
                                    <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" value="M" <?php echo isset($gender)? "":"checked" ?> <?php echo isset($gender) && $gender == 'M'? "checked" : '' ?>/>Male
                                    </div>
                                   <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" value="F"  <?php echo isset($gender) && $gender == 'F'? "checked" : '' ?>/>Female
                                    </div>
                                   
                               </div>
                               <div>
                                   <br />
                                   <h4 class="small font-weight-bold">Contact No
                                       <span class="float-right"></span></h4>
                                   <input type="text" class="form-control prodName" placeholder="Enter staff contact number" id="prodName" value="<?php echo isset($contactNo)? $contactNo : '' ?>" name="contactNo"> <br/>
                               </div>
                               
                               
                               
                           </div>
<!--                       Id : <?php echo isset($id)? $id:"" ?>
                       <br/>
                       Name : <input type="text" name="staffName" placeholder="Enter staff name" value="<?php echo isset($staffName)? $staffName : "" ?>"/>    
                       <br/>
                       Email : <input type="text" name="email" placeholder="Enter staff email" value="<?php echo isset($email)? $email:"" ?>"/>
                       <br/>
                       Gender : 
                       <input type="radio" name="gender" value="M" <?php echo isset($gender)? "":"checked" ?> <?php echo isset($gender) && $gender == 'M'? "checked" : '' ?>  />Male
                       <input type="radio" name="gender" value="F" <?php echo isset($gender) && $gender == 'F'? "checked" : '' ?>/>Female
                       <br>
                       Contact No : <input type="text" name="contactNo" placeholder="Enter staff contact number" value="<?php echo isset($contactNo)? $contactNo : '' ?>"/>
                       <br>-->
                      
                       <div class="addBtn"  style="margin: auto;">
                           <input type="submit" class="btn btn-success" value="Update" name="update"/>
                           
                           <input type="reset" class="btn btn-danger" value="Reset" name="addStaff"/>
                       </div>
<br />
<!--                       <input type="submit" value="Update" name="update"/>
                       <input type="reset" value="Cancel" name="addStaff"/>-->
                       </div>
                   </form>
                       
                       <div class="col-lg-12 mb-4">
                   <form action="" method="post">
                       <div class="card shadow mb-4">
                           <div class="card-header py-3">
                               <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                           </div>
                           <div class="card-body">
                               <div>
                                   <h4 class="small font-weight-bold">Old Password
                                       <span class="float-right"></span></h4>
                                   <input type="password" name="oldPassword" placeholder="" class="form-control" value="<?php echo isset($oldPassword)? $oldPassword:"" ?>"> <br/>
                               </div> 
                               <div>
                                   <h4 class="small font-weight-bold">New Password
                                       <span class="float-right"></span></h4>
                                   <input type="password" name="newPassword" placeholder="" class="form-control" value="<?php echo isset($oldPassword)? $oldPassword:"" ?>"> <br/>
                               </div>
                               <div>
                                   <h4 class="small font-weight-bold">Confirm Password
                                       <span class="float-right"></span></h4>
                                   <input type="password" name="confirmPassword" placeholder="" class="form-control" value="<?php echo isset($confirmPassword)? $confirmPassword:"" ?>" > <br/>
                               </div>
                               
                               <div class="addBtn"  style="margin: auto;">
                                   <input type="submit" class="btn btn-success" value="Change Password" name="changePassword"/>

                                   <input type="reset" class="btn btn-danger" value="Reset" name="resetPassword"/>
                               </div>
                               
                           </div>
<!--                       <h3>Edit password</h3>
                       Old Password : <input type="password" name="oldPassword" value="<?php echo isset($oldPassword)? $oldPassword:"" ?>" placeholder=""/>
                       <br/>
                       New Password : <input type="password" name="newPassword" value="<?php echo isset($newPassword)? $newPassword:"" ?>" placeholder=""/>
                       <br/>
                       Confirm Password : <input type="password" name="confirmPassword" value="<?php echo isset($confirmPassword)? $confirmPassword:"" ?>" placeholder=""/>
                       <br/>
                       <br/>
                       <input type="submit" value="Change Password" name="changePassword"/>
                       <input type="reset" value="Reset" name="resetPassword"/>-->
                   </div>
                   </form>
                           </div>
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
