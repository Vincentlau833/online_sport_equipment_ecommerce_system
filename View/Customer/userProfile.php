<?php 
require_once '../../Control/custDA.php';
//require_once '../../Control/custDA_Facade.php';
require_once '../../Control/DAFacade.php';
require_once '../../Model/Customer.php';
//require_once '../../ErrorHandler/errorHandler.php';

require_once '../../SessionEncryption/SessionEncrypt.php';
require_once '../../SessionEncryption/config.php';
?>

<?php 
//get session
session_start();

//create session encrypt class
$sessionEncryption = new SessionEncrypt(SESSION_KEY);
if(isset($_SESSION['custID'])){
    $custID = $sessionEncryption->decrypt($_SESSION['custID']);
    $email = $sessionEncryption->decrypt($_SESSION['email']);
}else{
    echo '<script>alert("*Please login your account first.");</script>';
    echo '<script>window.location.href = "../login.php";</script>';
}




//$custDA = new CustDA();
$DAFacade = new DAFacade();
$result = $DAFacade->retrieveUser($email);

if($row = $result->fetch_object()){
    //retrieve all the attributes
    $userName = $row->userName;
    $contactNo = $row->contactNo;
}

if(isset($_POST['updateProfile'])){
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    
    
    
    //$custDA = new CustDA();
    $DAFacade = new DAFacade();
    //validation for edit profile
    $validationEmail = $DAFacade->validateEmail($email);
    $validationUsername = $DAFacade->validateUsername($userName);
    $validationContactNo = $DAFacade->validateContactNo($contactNo);
    
    if($validationEmail == null && $validationUsername == null && $validationContactNo == null){
    
    
        $updateSuccess = $DAFacade->updateProfile($custID, $userName, $email, $contactNo);
    
        if($updateSuccess){
            echo '<script>alert("Update Successful");</script>';
        }else{
            echo '<script>alert("Update fail");</script>';
        }
    }else{
        if($validationEmail != null){
            echo '<script>alert("'.$validationEmail.'");</script>';
        }else if($validationUsername != null){
            echo '<script>alert("'.$validationUsername.'");</script>';
        }else if($validationContactNo != null){
            echo '<script>alert("'.$validationContactNo.'");</script>';
        }
    }
    
}

//retrieve address
$address = $DAFacade->retrieveAddress($custID);



if(isset($_POST['updateAddress'])){
    $addLine1 = $_POST['addLine1'];
    $addLine2 = $_POST['addLine2'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = "Malaysia";
    
    $custDA = new custDA();
    $validationAddLine1 = $DAFacade->validateAddressLine($addLine1);
    $validationAddLine2 = $DAFacade->validateAddressLine($addLine2);
    $validationPostcode = $DAFacade->validatePostcode($postcode);
    $validationCity = $DAFacade->validateCity($city);
    $validationState = $DAFacade->validateState($state);
    
    
    if($validationAddLine1 == null && $validationAddLine2 == null && $validationPostcode == null && $validationCity == null && $validationState == null){
        $address = new Address($addLine1,$addLine2,$postcode,$city,$state,$country);
    
    
    
        $updateSuccess = $DAFacade->updateAddress($custID, $address);
    
        if($updateSuccess){
            echo '<script>alert("Update Successful");</script>';
        }else{
            echo '<script>alert("Update fail");</script>';
        }
    }else{
        if($validationAddLine1 != null){
            echo '<script>alert("'.$validationAddLine1.'");</script>';
        }else if($validationAddLine2 != null){
            echo '<script>alert("'.$validationAddLine2.'");</script>';
        }else if($validationPostcode != null){
            echo '<script>alert("'.$validationPostcode.'");</script>';
        }else if($validationCity != null){
            echo '<script>alert("'.$validationCity.'");</script>';
        }else if($validationState != null){
            echo '<script>alert("'.$validationState.'");</script>';
        }
    }
    
}


?>

<?php
        if(isset($_POST['logoutBtn'])){
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
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
// put your code here
require_once '../requiredFile/header.php';

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
        <link href="../css/userProfile.css" rel="stylesheet" type="text/css"/>
       
    </head>
    <body  style="display: grid; grid-template-columns: auto;">
        <div class="body">
        <div class="profile-body">
            <form action="" method="POST" class="logoutForm">
                <div id="logout btn">
                    <input type="submit" name="logoutBtn"  class="btn btn-danger btn-lg logoutBtn" value="Logout" >
                </div>
            </form>
        
        <div class="">
            <!-- Contact detail -->
            <div class="col-xxl-8 mb-5 mb-xxl-0">
                <div class="bg-secondary-soft px-4 py-5 rounded">
                    <form action="" method="post">
                         
                    <div class="row g-3">
                       
                        <h4 class="mb-4 mt-0">User Profile</h4>
                        
                        <div class="col-md-6">
                            <label class="form-label" id="custidlbl">Customer ID</label>
                            <input type="text" id="custID" class="form-control" placeholder="" aria-label="Customer ID" value="<?php echo $custID ?>" disabled >
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label" id="usernamelbl">Username</label>
                            <input type="text" class="form-control name" placeholder="" aria-label="Username" value="<?php echo $userName ?>" name="userName">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label"  id="phonelbl">Phone number</label>
                            <input type="text" class="form-control phnum" placeholder="" aria-label="Phone number" value="<?php echo $contactNo ?>" name="contactNo">
                        </div>
                    
                        <div class="col-md-6">
                            <label class="form-label"  id="emaillbl">Email</label>
                            <input type="email" class="form-control mail" id="inputEmail4" value="<?php echo $email ?>" name="email">
                        </div>
                      

                    </div> <!-- Row END -->
                    <div id="editbtn">
                        <input type="submit"  class="btn btn-primary btn-lg savebtn"  value="Update profile" name="updateProfile"/>
                    </div>
                    
                    </form>
                </div>
            </div>
        </div>
        
        </div> 
           
            <form action="" method="POST" style="visibility: hidden;">
                <div id="logout btnad">
                    <input type="submit" name="asdlogoutBtn"  class="btn btn-primary btn-lg" value="Logout" >
                </div>
            </form>
        
        <div class="delivery-body">

            <div class="">
                <div class="col-xxl-8 mb-5 mb-xxl-0">
                    <div class="bg-secondary-soft px-4 py-5 rounded">
                        <form action="" method="POST">
                            <div class="row g-3">

                                <h4 class="mb-4 mt-0">Delivery Details</h4>

                                <div class="col-md-6">
                                    <label class="form-label" id="add1">Address Line 1</label>
                                    <input type="text" id="add1" class="form-control add1" placeholder="" aria-label="Address Line 1" value="<?php echo $address->getAddressLine1() ?>" name="addLine1">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" id="add2">Address Line 2</label>
                                    <input type="text" class="form-control add2" placeholder="" aria-label="Address Line 2" value="<?php echo $address->getAddressLine2() ?>" name="addLine2">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"  id="postcode">Postcode</label>
                                    <input type="text" class="form-control postcode" placeholder="" aria-label="Postcode" value="<?php echo $address->getPostcode() ?>" name="postcode">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label"  id="city">City</label>
                                    <input type="text" class="form-control city" placeholder="" aria-label="Phone number" value="<?php echo $address->getCity() ?>" name="city">
                                </div>
                                
                                <div>
                                <label class="form-label"  id="state">States</label>
                                <select class="form-select state" aria-label="States" name="state">
<!--                                    <option <?php //echo isset($address->getCity())? "":'selected' ?>>States</option>-->
                                    <option value="Johor"  <?php echo $address->getState() == "Johor"? "selected":'' ?>>Johor</option>
                                    <option value="Kedah" <?php echo $address->getState() == "Kedah"? "selected":'' ?>>Kedah</option>
                                    <option value="Kelantan" <?php echo $address->getState() == "Kelantan"? "selected":'' ?>>Kelantan</option>
                                    <option value="Kuala Lumpur" <?php echo $address->getState() == "Kuala Lumpur"? "selected":'' ?>>Kuala Lumpur</option>
                                    <option value="Labuan" <?php echo $address->getState() == "Labuan"? "selected":'' ?>>Labuan</option>
                                    <option value="Melaka" <?php echo $address->getState() == "Melaka"? "selected":'' ?>>Melaka</option>
                                    <option value="Negeri Sembilan" <?php echo $address->getState() == "Negeri Sembilan"? "selected":'' ?>>Negeri Sembilan</option>
                                    <option value="Pahang" <?php echo $address->getState() == "Pahang"? "selected":'' ?>>Pahang</option>
                                    <option value="Penang" <?php echo ($address->getState()) == "Penang"? "selected":'' ?>>Penang</option>
                                    <option value="Perak" <?php echo $address->getState() == "Perak"? "selected":'' ?>>Perak</option>
                                    <option value="Perlis" <?php echo $address->getState() == "Perlis"? "selected":'' ?>>Perlis</option>
                                    <option value="Putrajaya" <?php echo $address->getState() == "Putrajaya"? "selected":'' ?>>Putrajaya</option>
                                    <option value="Sabah" <?php echo $address->getState() == "Sabah"? "selected":'' ?>>Sabah</option>
                                    <option value="Sarawak" <?php echo $address->getState() == "Sarawak"? "selected":'' ?>>Sarawak</option>
                                    <option value="Selangor" <?php echo $address->getState() == "Selangor"? "selected":'' ?>>Selangor</option>
                                    <option value="Terengganu" <?php echo $address->getState() == "Terengganu"? "selected":'' ?>>Terengganu</option>
                                    

                                </select>
                                </div>
                            </div>
                            <div id="editDelivery">
                                <input type="submit"  class="btn btn-primary btn-lg editDelivery" onclick="changeMessageDelivery()" value="Update Delivery Address" name="updateAddress"/>
                            </div>
                            
                        </form>
        

                    </div>
                </div>
            </div>

        </div> 
        </div>
        <br />
        <br/>
        <?php
        require_once '../requiredFile/footer.php';
        ?>
        
    </body>
<!--    <script>
        //profile
        $(document).ready(function() {
        //Disable Save Button On Page Load
        $(".savebtn").attr('disabled', 'disabled');

        
        $(".name").keyup(function() {
        $(".savebtn").removeAttr('disabled');
        });
        
        $(".phnum").keyup(function() {
        $(".savebtn").removeAttr('disabled');
        });
        
        $(".mail").keyup(function() {
        $(".savebtn").removeAttr('disabled');
        });

        //Disable Save Button once clicked
        $(".savebtn").click(function() {
        $(this).attr('disabled', 'disabled');
        });
        });
        
        
        
        //delivery Address
        $(document).ready(function () {
        //Disable Save Button On Page Load
        $(".editDelivery").attr('disabled', 'disabled');

        
        $(".add1").keyup(function() {
        $(".editDelivery").removeAttr('disabled');
        });
        
        $(".add2").keyup(function() {
        $(".editDelivery").removeAttr('disabled');
        });
        
        $(".postcode").keyup(function() {
        $(".editDelivery").removeAttr('disabled');
        });
        
        $(".city").keyup(function() {
        $(".editDelivery").removeAttr('disabled');
        });
        
        $(".state").change(function() {
        $(".editDelivery").removeAttr('disabled');
        });

        //Disable Save Button once clicked
        $(".editDelivery").click(function() {
        $(this).attr('disabled', 'disabled');
        });
        });
        
        function changeMessageProfile() {
        alert("Profile Information Change Successfully");
        }
        
        function changeMessageDelivery() {
        alert("Delivery Information Change Successfully");
        }
    </script>-->
</html>
