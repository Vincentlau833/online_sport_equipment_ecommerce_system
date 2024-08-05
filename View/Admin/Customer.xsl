<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="/">
    <html>
        <head>
            <meta charset="utf-8"/>
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
            <meta name="description" content=""/>
            <meta name="author" content=""/>

            <title>Customer Statistics</title>

            <!-- Custom fonts for this template-->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
            <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"/>
            <link
                href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet"/>
            <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"/>
            <link href="../css/productList.css" rel="stylesheet" type="text/css"/>
            <link href="../css/adminHome.css" rel="stylesheet" type="text/css"/>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
          
                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Gender', 'Count'],
                ['Male', <xsl:value-of select="count(Customers/Customer[gender='M'])"/>],
                ['Female', <xsl:value-of select="count(Customers/Customer[gender='F'])"/>]
                ]);
            
                var options = {
                title: 'Gender Distribution',
                pieHole: 0.4
                };
            
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
                }
            </script>
        </head>
            <body>
          <div id="wrapper">
            <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminHome.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">SweatLab Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0"/>

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="adminHome.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Summary</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider"/>

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
                <hr class="sidebar-divider"/>

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
                
               
                
                <hr class="sidebar-divider"/>
                
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
                <hr class="sidebar-divider"/>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="staffProfile.php" >
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Profile</span>
                    </a>
                    
                </li>

             

                

            </ul>
            <!--///////////////////////////////////////////////-->
              <div id="content-wrapper" class="d-flex flex-column">
                  <div id="content" class="col-lg-12" style="padding-top: 20px;">
                      <div class="container-fluid">
                          <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Customer Statistics</h1>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <div id="content-wrapper" class="d-flex flex-column">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div>
                                            <h4 class="small font-weight-bold">Total number of customers
                                                <span class="float-right"></span></h4>
                                                <input class="form-control" disabled="disabled" type="text" value="{count(Customers/Customer)}"/>
                                        </div>
                                        <br />
                                        <div>
                                            <h4 class="small font-weight-bold">Number of male customers
                                                <span class="float-right"></span></h4>
                                                <input class="form-control" disabled="disabled" type="text" value="{count(Customers/Customer[gender='M'])}"/>
                                        </div>
                                        <br />
                                        <div>
                                            <h4 class="small font-weight-bold">Number of female customers
                                                <span class="float-right"></span></h4>
                                                <input class="form-control" disabled="disabled" type="text" value="{count(Customers/Customer[gender='F'])}"/>
                                        </div>
                                       
                                        
                                        
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      
                      
                      <!--Pie chart part-->
                      
                      <div id="content" class="col-lg-12" style="padding-top: 20px;width:40%;">
                          <div class="container-fluid">
                              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                  <h1 class="h3 mb-0 text-gray-800">Pie Chart</h1>
                              </div>
                              <div class="col-lg-12 mb-4">
                                  <div id="content-wrapper" class="d-flex flex-column">
                                      <div class="card shadow mb-4">
                                          <div class="card-body">
                                              
                                              <div id="chart_div" style="width: 400px; height: 300px;"></div>
                              
                                                  
                                          </div>
                                    
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      <footer>
                          <div class="container my-auto">
                              <div class="copyright text-center my-auto">
                                  <span>Copyright &#169; SweatLab 2023</span>
                              </div>
                          </div>
                      </footer>
                      
                      
                  </div>
                  
              </div>
              
              
       
<!--        <h2>Customer Statistics</h2>
        <p>Total number of customers: <xsl:value-of select="count(Customers/Customer)" /></p>
        <p>Number of male customers: <xsl:value-of select="count(Customers/Customer[gender='M'])" /></p>
        <p>Number of female customers: <xsl:value-of select="count(Customers/Customer[gender='F'])" /></p>-->
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>
