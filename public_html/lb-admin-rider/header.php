<?php
@ob_start();
@session_start();
include '../connection.php';
if(!isset($_SESSION["userid"]))
{
		header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laundry Bucket Admin Panel! | </title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/bootstrap-table/bootstrap-table.min.css">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom2.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/progressbar/bootstrap-progressbar-3.3.0.css">
     <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mystyle.css">
    
    <link href="../assets/bootstrap-timepicker.min.css" rel="stylesheet">
  
    
     <script src="js/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
      <script src="css/bootstrap-table/bootstrap-table.js"></script>
    <script src="css/bootstrap-table/extension/multiple-search/bootstrap-table-multiple-search.js"></script>
   <script src="../assets/formvalidation.js"></script>
   <script src="js/jquery.blockUI.js"></script>
    <!--<script src="css/bootstrap-table.min.js"></script>-->
   
  <style>
  .nav .open > a, .nav .open > a:hover, .nav .open > a:focus {
    background-color: #535353;
    border-color: #070809;
   }
  </style>
  
  
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <script>
        $(function() {
        
  $('#lst-group-item').on('click', function() {
    $('.fa', this)
      .toggleClass('fa fa-plus')
      .toggleClass('fa fa-minus');
  });

});
        </script>

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">  <!--left menu started from here-->
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;"> <!-- edited as navbar-inverse -->
                        <a class="site_title"><img src="../washing11.png"> </img> <span>Laundry Bucket!</span></a>
                    </div>
                    <div class="clearfix"> </div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                    
                        <div class="profile_pic">
                            <img src="../avatar23.png" alt="..." class="img-circle profile_img	">
                        </div>
                    
                        <div class="profile_info">
                            <span>Welcome,</span>
                           <!-- <h2> Admin</h2>-->
<?php
$loginroleid=$_SESSION['loginrole'];
$res=mysql_query("select * from tbl_employee_role where roleId='$loginroleid'") or die(mysql_error());
$rowss=mysql_fetch_array($res);
echo "<h2 style='color:#000;'>".$rowss['roleName']."</h2>";

?>	                           
                           
                            
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                           <!-- <h3>General</h3>-->
                           <h3> &nbsp;</h3>
                            <ul class="nav side-menu">
                                <li><a href="reguserlist_new.php"><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                   <!-- <ul class="nav child_menu" style="display: none">-->
                                      <!--  <li><a href="regclient.php">Registerd Clients</a>
                                      </li>-->
                                        
                                        <!-- start of unused code
                                        <li><a href="index2.html">Dashboard2</a>
                                        </li>
                                        <li><a href="index3.html">Dashboard3</a>
                                        </li>
                                        end of unused code-->
                                   <!-- </ul>-->
                                </li>
                                
                                <li class="ord">
                                	 
                                
                                
                                  <li class="ord"><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                                
                                    <ul class="nav child_menu" style="display: none">
                                    	
                                      <!--  <li><a href="reguserlist.php">Users List</a>
                                      </li>-->
                                        
                                        <li><a href="add_user.php">Add Users</a>
                                        </li>
                                       
                                        <li><a href="reguserlist_new.php">Users List (New*)</a>
                                        </li>
                                       </ul>
                                      
                                </li>
                                
                                
                               
                                <li><a><i class="fa fa-history"></i> Orders <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                    	
                                    	<!--<li><a href="create_neworder.php">Create New Orders</a><!--<a href="create_order.php">Create New Orders</a>--> </li>
                                    	
                                    	<!--<li><a href="allorder_list.php">All  Orders</a> </li>-->
                                    	
                                    
                                    	
                                    	<li><a href="allorder_list_new.php">All  Orders (New*)</a> </li>
                                    	<li><a href="customer_info.php">Create New Orders (New*)</a> </li>
                                    	
                                    	<li><a href="today_pickup.php">Today Pickup</a></li>
                                    	
                                    	<li><a href="today_deliver.php">Today Deliveries</a></li>
                                    	
                                    	<li><a href="pending_pickup.php">Pending Pickup</a></li>
                                    	
                                    	<li><a href="pending_deliver.php">Pending Deliveries</a></li>
                                    	
                                    	
                                    	<li><a href="cancelled_orderslist.php">Cancelled  Orders</a> </li>
                                    	
                                    	<li><a href="allorder_list_old.php">All  Orders (Old)</a> </li>
                                    	
                                    	<!--
                                    	<li><a href="drycleanorder_list.php">Dryclean Orders</a> </li>
                                    	
                                    	<li>
                                    		<a href="#item-1" id="lst-group-item" data-toggle="collapse">
    <i class="fa fa-plus" id="nestedi"> <span style="font-size:25px"></i>
    	Laundry Orders  
  </a>
  
    
     <ol class="list-group collapse" id="item-1">
      <a href="trialorder_list.php" class="list-group-item" id="lst-group-item">Trial Orders</a>
      <a href="normalorder_list.php" class="list-group-item" id="lst-group-item">Normal Orders</a>
      <a href="subscription_orderlist.php" class="list-group-item" id="lst-group-item">Subscription Orders</a>
    </ol>
                                    		</li>
                                    		
         -->
                             
                                       <!--
                                       
                                          <li><a href="create_order.php">Create Dryclean order</a>
                                        </li>
                                        
                                         <li><a href="create_laundryorder.php">Create Laundry order</a>
                                        </li>
                                        
                                          <li><a href="cancelledorderlist.php">Cancelled order List</a>
                                        </li>
                                        
                                        
                                        <li><a href="clienthistory.php">client order history</a>
                                        </li>
                                       -->
                                       </ul>
                                </li>
                                
                                
                                  <li class="ord"><a href="subscriptionlist.php"><i class="fa fa-history"></i>Subscriptions <span class="fa fa-chevron-down"></span></a>
                                    <!--<ul class="nav child_menu" style="display: none">
                                    	
                                    	<li><a href="subscriptionlist.php"> Subscription List</a> </li>
                                    	 <?php if($_SESSION['loginrole']==2){?>
                                         <li><a href="add_subscription.php">Add Subscription</a> </li>
                                        <?php } ?>
                                      </ul>-->
                                </li>
                                
                                
                               <!--  <li class="ord"><a><i class="fa fa-table"></i>Drycleaning <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="productslist.php">All Products</a>
                                        </li>
                                        <?php if($_SESSION['loginrole']==2){?>
                                        <li><a href="add_products.php">Add New Product</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                               -->
                                
                                
                                
                                  <li class="ord"><a><i class="fa fa-history"></i>User Subscriptions <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                    	
                                    	<li><a href="usersubscription.php?ref=inactive"> Latest Inactive</a> </li>
                                         <li><a href="usersubscription.php?ref=activated">Activated</a>
                                         	
                                         	<!-- <li><a href="usersubscription.php?ref=completed">Completed</a>-->
                                        </li>
                                       </ul>
                                </li>
                                
                                  <li><a href="datetodate.php"><i class="fa fa-file-excel-o"></i> Get orders Excel </a>
                                
                                <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                 <li class="ord"><a href="querycontact.php"><i class="fa fa-plus" aria-hidden="true"></i> Contact US Query</a>
                                 	
                                 	<?php } ?>
                                  	<!--
                                    <ul class="nav child_menu" style="display: none">
                                    	
                                        <li><a href="querycontact.php">View Query List</a>
                                        </li>
                                       
                                       </ul>
                                      -->

                                </li>
                                
                              <li><a href="ratelist.php"><i class="fa fa-plus" aria-hidden="true"></i> Rate List </a>
                               
                               <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                               <li class="ord"><a><i class="fa fa-table"></i>SERVICE Category <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="service_catlist.php">Service Category</a>
                                        </li>
                                        <?php if($_SESSION['loginrole']==2){?>
                                        <li><a href="addservicecat.php">Add New Service Category</a>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </li>
                                
                                <?php } ?>
                                
                                <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                 <li class="ord"><a><i class="fa fa-table"></i>SERVICES<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="service_list.php">Services</a>
                                        </li>
                                         <?php if($_SESSION['loginrole']==2){?>
                                        <li><a href="add_services.php">Add New Services</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                
                                <?php } ?>
                                
                                <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                <li class="ord"><a><i class="fa fa-table"></i>SERVICE Item<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="service_item_list.php">Service Item</a>
                                        </li>
                                         <?php if($_SESSION['loginrole']==2){?>
                                        <li><a href="add_service_item.php">Add New Service Item</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                
                                <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                 <li class="ord"><a><i class="fa fa-table"></i>Payment Details<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="pending_invoice.php">Pending Invoices</a>
                                        </li>
                                        <li><a href="paid_invoice.php">Paid Invoices</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php } ?>
                                
                                <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                <li class="ord"><a><i class="fa fa-table"></i>Feedback Status<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="view_feedback.php">View Customer Feedback</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <?php } ?>
                                
                                <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                 <li class="ord"><a><i class="fa fa-table"></i>Employee Roles<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="employee_rolelist.php">Employee Roles List</a>
                                        </li>
                                         <?php if($_SESSION['loginrole']==2){?>
                                        <li><a href="addemployee_role.php">Add New Employee Role</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                
                                <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
                                <li class="ord"><a><i class="fa fa-table"></i>Employee Registration<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="employee_list.php">Employee List</a>
                                        </li>
                                         <?php if($_SESSION['loginrole']==2){?>
                                        <li><a href="add_employee.php">Add New Employee</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php }?>
                                
                                  <li class="ord"><a href="offer_list.php"><i class="fa fa-tags"></i>Offers<span class="fa fa-chevron-down"></span></a>
                                    <!--<ul class="nav child_menu" style="display: none">
                                        <li><a href="offer_list.php">Offers List</a>
                                        </li>
                                         <?php if($_SESSION['loginrole']==2){?>
                                        <li><a href="add_offer.php">Add New Offer</a>
                                        </li>
                                        <?php } ?>
                                    </ul>-->
                                </li>
                               
                                
                                <!--
                                <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="chartjs.html">Chart JS</a>
                                        </li>
                                        <li><a href="chartjs2.html">Chart JS2</a>
                                        </li>
                                        <li><a href="morisjs.html">Moris JS</a>
                                        </li>
                                        <li><a href="echarts.html">ECharts </a>
                                        </li>
                                        <li><a href="other_charts.html">Other Charts </a>
                                        </li>
                                    </ul>
                                </li>
                                end of unused code-->
                            </ul>
                        </div>
                        
                        <!-- start of unused code
                        <div class="menu_section">
                            <h3>Live On</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="e_commerce.html">E-commerce</a>
                                        </li>
                                        <li><a href="projects.html">Projects</a>
                                        </li>
                                        <li><a href="project_detail.html">Project Detail</a>
                                        </li>
                                        <li><a href="contacts.html">Contacts</a>
                                        </li>
                                        <li><a href="profile.html">Profile</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="page_404.html">404 Error</a>
                                        </li>
                                        <li><a href="page_500.html">500 Error</a>
                                        </li>
                                        <li><a href="plain_page.html">Plain Page</a>
                                        </li>
                                        <li><a href="login.html">Login Page</a>
                                        </li>
                                        <li><a href="pricing_tables.html">Pricing Tables</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a>
                                </li>
                            </ul>
                        </div>
						end of unused code-->
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                    	<!--
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                       -->
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div><!--left menu started from here-->

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                    	<div class="col-md-4">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        </div>
                        <div class="col-md-4">
						<button class="btn btn-default" style="margin-top: 5px;" id="btnNewOrder">New Orders &nbsp;<span class="badge"></span></button>
						</div>
						<div class="col-md-4">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                               Laundry Bucket Admin Panel
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                	
                                	<!-- srat of unused code
                                    <li><a href="javascript:;">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Help</a>
                                    </li>
                                   end of unused code-->
                                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

							<!-- start of  unused code
                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="inbox.html">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
							end of unused code-->
                        </ul>
                       </div>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


           

