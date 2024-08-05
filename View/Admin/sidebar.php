<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"><!-- comment -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Sidebar -->
            <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminHome.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">SweatLab Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="adminHome.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Summary</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Product
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="productList.php" >
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Products List</span>
                    </a>
                    
                </li>
                
                <li class="nav-item">
                    <a class="nav-link collapsed" href="addProduct.php" >
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Add Product</span>
                    </a>
                    
                    
                </li>
                
           
                
                
                

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Users
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="userList.php" >
                        <i class="fas fa-fw fa-folder"></i>
                        <span>User List</span>
                    </a>
                    
                </li>
                
               
                
                <hr class="sidebar-divider">
                
                <div class="sidebar-heading">
                    Staff
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="staffList.php" >
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Staff List</span>
                    </a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="addStaff.php" >
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Add Staff</span>
                    </a>
                    
                </li>
                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a class="nav-link collapsed" href="staffProfile.php" >
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Profile</span>
                    </a>
                    
                </li>

             

                

            </ul>
        <?php
        // put your code here
        ?>
    </body>
</html>
