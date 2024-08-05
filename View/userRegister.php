<?php
require_once '../Control/custDA.php';
require_once '../Model/Customer.php';
//require_once '../Control/custDA_Facade.php';
require_once '../Control/DAFacade.php';
require_once '../ErrorHandler/loginRegisterErrorHandler.php';
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
        <style type="text/css">
        .auto-style2 {
            width: 400px;
            padding-left: 10%;
        }
        .auto-style3 {
            background-color: whitesmoke;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 9px;
            width: 402px;
        }
        </style>
        <script src="https://use.fontawesome.com/f9fd45026c.js"></script>
        <link href="css/register.css" rel="stylesheet" type="text/css"/>
        <title>Register</title>
    </head>
    <body>
        <div id="candidateRegisterForm" runat="server">
            <table id="registerCandidateTable" class="auto-style1">
                <tr>
                    <td class="regTable-left">
                        <img src="images/register.png" />

                    </td>
                    <td class="auto-style3">
                        <h2>Sign Up</h2>
                        <?php
                        if(!empty($_POST)){
                            $userName = $_POST['userName'];
                            $email = $_POST['email'];
                            $gender = $_POST['gender'];
                            $password = $_POST['password'];
                            $confirmPassword = $_POST['confirmPassword'];
                            
                            
                            //$custDA = new custDA();
                            $DAFacade = new DAFacade();
                            //validation
                            $validationUsername = $DAFacade->validateUsername($userName);
                            $validationEmail = $DAFacade->validateEmail($email);
                            $validationPassword = $DAFacade->validatePassword($password,$confirmPassword);
                            $emailRedundant = $DAFacade->checkEmailRedundant($email);//check the email already register by other ppl
                          
                            if($validationUsername == null && $validationEmail == null && $validationPassword == null && !$emailRedundant){
                                //hash the password before store into the database
                                $hashed_password = password_hash($password, PASSWORD_ARGON2ID);
                                
                                $customer = new Customer($userName, $email, $hashed_password, $gender,"Active");
                                
                                $insertSuccessful = $DAFacade->register($customer);

                                if($insertSuccessful){
//                                  echo '<script>alert("Register Successful!");</script>';
//                                  header('Location: login.php');
                                    echo '<script>alert("Register Successful!"); window.location.href = "login.php";</script>';

                                }else{
                                    header('Location: userRegister.php');
                                }
                            }else{
                                if($validationUsername != null){
                                    echo '<script>alert("'.$validationUsername.'");</script>';
                                }else if($validationEmail != null){
                                    echo '<script>alert("'.$validationEmail.'");</script>';
                                }else if($validationPassword != null){
                                    echo '<script>alert("'.$validationPassword.'");</script>';
                                }else if($emailRedundant){
                                    echo '<script>alert("Email has been registered, please enter again.");</script>';
                                }
                            }
                            
                            
                            
                        }else{
                            
                        }
                        ?>
                        <form action="" method="POST">
                        <div class="auto-style2">
                            <br />
                            <p class="label"><b>Username</b></p>
                            <i class="fa fa-user" id="registerIcon1" aria-hidden="true"></i>
                            <input type="text" class="input" placeholder="Full Name" name="userName" value="<?php echo isset($userName)? $userName : '' ?>">
                            <br/>
                            <p class="label"><b>Email</b></p>
                            <i class="fa fa-envelope" id="registerIcon2" aria-hidden="true"></i>
                            <input type="email" class="input" placeholder="Email"name="email" value="<?php echo isset($email)? $email : '' ?>">
                            <br />
                            <p class="label"><b>Please Select Your Gender</b></p>
                            <input type="radio" id="male" name="gender" value="M" <?php echo isset($gender)? "":"checked" ?> <?php echo isset($gender) && $gender == 'M'? "checked" : '' ?>>
                              Male
                            <input type="radio" id="female" name="gender" value="F" <?php echo isset($gender) && $gender == 'F'? "checked" : '' ?>>
                              Female
                            <br>
                            <p class="label"><b>Password</b></p>
                            <i class="fa fa-lock" aria-hidden="true" id="registerIcon3"></i>
                            <input type="password" class="input" placeholder="password" name="password">
                            <br />
                            <p class="label"><b>Re-Enter Password</b></p>
                            <i class="fa fa-lock" aria-hidden="true" id="registerIcon3"></i>
                            <input type="password" class="input" placeholder="password" name="confirmPassword">
                            <br />
                           <br />
                            <br />
                            <div class="submit">
                                <input type="submit" class="RegisterButton" name="name" value="Register">
                             </div>
                            <br />
                            <div class="loginNow">
                                <a href="login.php" style="text-decoration: none;">Click Here to Login</a>
                            </div>
                            <br />

                        </div>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
