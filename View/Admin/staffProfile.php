<?php
require_once '../../Control/custDA.php';
require_once '../../Model/staff.php';
//require_once '../../Control/staffDA_Facade.php';
require_once '../../Control/DAFacade.php';
//require_once '../../ErrorHandler/errorHandler.php';

require_once '../../SessionEncryption/SessionEncrypt.php';
require_once '../../SessionEncryption/config.php';

require_once 'staffAuthorize.php';
?>
<html>
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Profile</title>

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
    <?php
    //retrieve staff id from session
    //session_start();
    
    //create session encrypt class
    $sessionEncryption = new SessionEncrypt(SESSION_KEY);
    //check the role == staff
    if(isset($_SESSION['role'])){
        $role = $sessionEncryption->decrypt($_SESSION['role']);
    }
    if(strcasecmp($role, "Staff") == 0){
        //role == staff
        if(isset($_SESSION['staffID'])){
            $staffID = $sessionEncryption->decrypt($_SESSION['staffID']);
        }
        
        $DAFacade = new DAFacade();
        $result = $DAFacade->retrieveStaff($staffID);
        
        if($row = $result->fetch_object()){
            $staffName = $row->staffName;
            $email = $row->email;
            if(strcasecmp($row->gender, 'M') == 0){
                $gender = "Male";
            }else{
                $gender = "Female";
            }
            $contactNo = $row->contactNo;
        }
        
        
    }else if(strcasecmp($role,"Admin")){
        //role == admin
    }
    
    
    
    
    
    
    //logout
    if(isset($_POST['logout'])){
         // clear the session data
         session_unset();
         //session_destroy();
        
         // remove the session cookie
         setcookie(session_name(), '', time() - 3600, '/');
            
         if (empty($_SESSION['username'])) {
               echo '<script>alert("Logout");window.location.href = "../login.php";</script>';
         }
    }
    ?>
    <body id="page-top">
        <div id="wrapper">
            <?php
            require_once 'sidebar.php';
            ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content" style="padding-top: 20px;">
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <div id="content-wrapper" class="d-flex flex-column">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div>
                                            <h4 class="small font-weight-bold">Staff ID 
                                                <span class="float-right"></span></h4>
                                            <input class="form-control" type="text" disabled  value="<?php echo (isset($staffID))? $staffID : "" ?>"/>
                                            <br/>
                                        </div>
                                        <div>
                                            <h4 class="small font-weight-bold">Name
                                                <span class="float-right"></span></h4>
                                            <input class="form-control" type="text" disabled  value="<?php echo isset($staffName) ? $staffName : "" ?>"/>
                                            <br/>
                                        </div>
                                        <div>
                                            <h4 class="small font-weight-bold">Email
                                                <span class="float-right"></span></h4>
                                            <input class="form-control" type="text" disabled  value="<?php echo (isset($email))? $email : "" ?>"/>
                                            <br/>
                                        </div>
                                        <div>
                                            <h4 class="small font-weight-bold">Gender
                                                <span class="float-right"></span></h4>
                                            <input class="form-control" type="text" disabled  value="<?php echo (isset($gender))? $gender : "" ?>"/>
                                            <br/>
                                        </div>
                                        <div>
                                            <h4 class="small font-weight-bold">Contact No
                                                <span class="float-right"></span></h4>
                                            <input class="form-control" type="text" disabled  value="<?php echo (isset($contactNo))? $contactNo : "" ?>"/>
                                            <br/>
                                        </div>
                                        <div class="text-center">
                                            <form action="" method="POST">
                                                <input style="" class="btn btn-dark" type="submit" name="logout" value="Logout"/>
                                            </form>
                                        </div>
                                    </div>
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
