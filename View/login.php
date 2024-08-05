<?php
require_once '../Control/custDA.php';
require_once '../Control/userFactory.php';
require_once '../Model/Customer.php';
require_once '../Model/Admin.php';
require_once '../Control/DAFacade.php';
require_once '../SessionEncryption/SessionEncrypt.php';
require_once '../SessionEncryption/config.php';
//require_once '../ErrorHandler/loginRegisterErrorHandler.php';






//header('Location: login.php');
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <script src="https://use.fontawesome.com/f9fd45026c.js"></script>
        <link href="css/login.css" rel="stylesheet" type="text/css"/>
        <link href="Css/Login.css" rel="stylesheet" />
        <style type="text/css">
            .tr1 {
                width: 365px;
            }
            .tr2 {
                width: 126px;
            }
        </style>
    </head>
    <body>
        <?php
        //hardcode admin information
        $admin = new Admin("Admin", "admin@gmail.com", "pwd", "M");
        
        if(!empty($_POST)){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            //$custDA = new custDA();
            $DAFacade = new DAFacade();
            
            $match = $DAFacade->matchUser($email, $password);
            if($match){
                //retrieve user id
                $result = $DAFacade->retrieveUser($email);
                if($row = $result->fetch_object()){
                    $custID = $row->custID;
                    $status = $row->status;//get status
                }
                if(strcasecmp($status, 'Active') == 0){
                    echo '<script>alert("Login Successful!");</script>';
                    //create session
                    session_start();
                    //create session encrypt class
                    $sessionEncryption = new SessionEncrypt(SESSION_KEY);
                
                    $_SESSION['custID'] = $sessionEncryption->encrypt($custID);
                    $_SESSION['email'] = $sessionEncryption->encrypt($email);
                    $_SESSION['role'] = $sessionEncryption->encrypt('Customer');
                    if(isset($_SESSION['custID'])){
                        //echo '<script>window.location.href = "../View/Customer/home.php";</script>';
                        echo userFactory::redirectPageTo('Customer');
                    }
                }else{
                    echo '<script>alert("Your account has been banned, please contact the administrator to activate your account.");</script>';
                }
                
            }else if($DAFacade->matchStaff($email, $password)){
                $result = $DAFacade->retrieveStaffByEmail($email);
                if($row = $result->fetch_object()){
                    $staffID = $row->staffID;
                }
                
                //create session for staff
                session_start();
                
                //create session encrypt class
                $sessionEncryption = new SessionEncrypt(SESSION_KEY);
                $_SESSION['staffID'] = $sessionEncryption->encrypt($staffID);
                $_SESSION['role'] = $sessionEncryption->encrypt('Staff');
                
                echo '<script>alert("Login Successful!");</script>';
                if(isset($_SESSION['staffID'])){
                    echo userFactory::redirectPageTo('Admin');
                }
            }else if($email == 'admin@gmail.com' && $password == 'pwd'){
                echo '<script>alert("Login Successful!");</script>';
                
                session_start();
                
                $sessionEncryption = new SessionEncrypt(SESSION_KEY);
                $_SESSION['role'] = $sessionEncryption->encrypt('Admin');
                
                if(isset($_SESSION['role'])){
                    echo userFactory::redirectPageTo('Admin');
                }
                
            }else{
                echo '<script>alert("Not Matched");</script>';
            }
            
        }
        ?>
        
        <div id="form">
            <div class="loginContent">
                <div id="icon">
                    <i class="fa fa-user-circle-o" style="font-size: 125px; padding-top: 20px; color:#415C4E;" aria-hidden="true"></i>
                </div>
                <h1 style="text-align:center; color:#415C4E;">Login</h1>
                <form action="" method="POST">
                <table class="formTable">
                
                    <tr>
                        <td class="tr2" id="emaillabel">Email</td>
                        <td class="tr1">
                            <input type="text" class="textEmail" required name="email"> &nbsp;
                        </td>
                    </tr>
                  
                 
                    <tr>
                        <td class="tr2" id="pwdlabel">Password</td>
                    <td class="tr1">
                        <input type="password" class="textPwd" required name="password">&nbsp;
                    </td>
                    </tr>
                  
                    <tr class="btnContainer">
                        <td class="tr2"  colspan="2"  style="padding-left: 10px;">
                            <input class="userBtnLogin" type="submit" value="Submit">
                        </td>
                    </tr>
                    <tr class="btnContainer">
                        <td colspan="2">
                            <div class="registerNow">
                                <a href="userRegister.php" style="text-decoration: none;">Register Here</a>
                            </div>
                        </td>
                    </tr> 
                </table>
               </form>
            </div>
        </div>
    </body>
</html>
